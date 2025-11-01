<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    /**
     * Guardar una nueva venta
     */
    public function store(Request $request)
    {
        $request->validate([
            'metodo_pago' => 'required|string|max:50',
            'total' => 'required|numeric|min:0',
            'productos' => 'required|array|min:1',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ]);

        // Crear la venta
        $venta = Venta::create([
            'fecha' => now(),
            'usuario_id' => Auth::id(),
            'total' => $request->total,
            'metodo_pago' => $request->metodo_pago,
        ]);

        // Guardar cada detalle de venta
        foreach ($request->productos as $item) {
            $producto = Producto::find($item['id']);
            if($producto) {
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $producto->precio,
                ]);
            }
        }

        return redirect()->route('ventas.index')
                         ->with('success', 'Venta registrada correctamente.');
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
                         ->with('success', 'Venta actualizada correctamente.');
    }

    /**
     * Eliminar una venta
     */
    public function destroy(Venta $venta)
    {
        // Eliminar detalles primero
        $venta->detalles()->delete();

        // Luego eliminar la venta
        $venta->delete();

        return redirect()->route('ventas.index')
                         ->with('success', 'Venta eliminada correctamente.');
    }
}
