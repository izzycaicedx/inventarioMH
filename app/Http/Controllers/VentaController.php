<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF; // ← Asegúrate de tener esta línea al inicio

class VentaController extends Controller
{
    /**
     * Mostrar todas las ventas
     */
    public function index()
    {
        $ventas = Venta::with('usuario')->latest()->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $productos = Producto::where('cantidad', '>', 0)->get(); // Solo productos con stock
        return view('ventas.create', compact('productos'));
    }

    /**
     * Guardar una nueva venta
     */
    public function store(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required|string|max:50',
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        // Validar stock antes de crear la venta
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['id']);
            if ($producto && $producto->cantidad < $item['cantidad']) {
                return back()->with('error', '❌ No hay suficiente stock de ' . $producto->nombre . '. Stock disponible: ' . $producto->cantidad);
            }
        }

        // Crear la venta
        $venta = Venta::create([
            'fecha' => now(),
            'usuario_id' => Auth::id(),
            'total' => $request->total,
            'metodo_pago' => $request->metodo_pago,
        ]);

        // Guardar los detalles y actualizar stock
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['id']);

            if ($producto) {
                // Registrar detalle de venta
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio, // CORREGIDO: precio_unitario → precio
                ]);

                // Descontar del stock
                $producto->cantidad -= $item['cantidad']; // CORREGIDO: stock → cantidad
                $producto->save();
            }
        }

        return redirect()->route('ventas.index')
                         ->with('success', '✅ Venta registrada correctamente y stock actualizado.');
    }

    /**
     * Mostrar una venta específica
     */
    public function show(Venta $venta)
    {
        $venta->load('detalles.producto', 'usuario');
        return view('ventas.show', compact('venta'));
    }

    /**
     * Mostrar formulario para editar una venta
     */
    public function edit(Venta $venta)
    {
        $productos = Producto::all();
        $venta->load('detalles');
        return view('ventas.edit', compact('venta', 'productos'));
    }

    /**
     * Actualizar venta existente
     */
    public function update(Request $request, Venta $venta)
    {
        $request->validate([
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string|max:50',
        ]);

        $venta->update([
            'fecha' => $request->fecha,
            'total' => $request->total,
            'metodo_pago' => $request->metodo_pago,
        ]);

        return redirect()->route('ventas.index')
                         ->with('success', '✅ Venta actualizada correctamente.');
    }

    /**
     * Eliminar una venta
     */
    public function destroy(Venta $venta)
    {
        // Restaurar stock antes de eliminar
        foreach ($venta->detalles as $detalle) {
            if ($detalle->producto) {
                $detalle->producto->increment('cantidad', $detalle->cantidad); // CORREGIDO: stock → cantidad
            }
        }

        // Eliminar detalles y la venta
        $venta->detalles()->delete();
        $venta->delete();

        return redirect()->route('ventas.index')
                         ->with('success', '🗑️ Venta eliminada correctamente y stock restaurado.');
    }

    /**
     * Obtener información de producto por ID (para AJAX)
     */
    public function getProducto($id)
    {
        $producto = Producto::find($id);

        if ($producto) {
            return response()->json([
                'success' => true,
                'producto' => [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'cantidad' => $producto->cantidad,
                    'descripcion' => $producto->descripcion
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Producto no encontrado'
        ], 404);
    }

    /**
     * Generar PDF de ventas
     */
    public function generarPDF()
    {
        $ventas = Venta::with('usuario', 'detalles.producto')->latest()->get();

        $pdf = PDF::loadView('ventas.pdf', compact('ventas'));

        return $pdf->download('reporte_ventas_' . date('Y-m-d') . '.pdf');
    }
}
