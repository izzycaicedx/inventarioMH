<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductoController extends Controller
{
    // ✅ Mostrar inventario general
    public function inventario()
    {
        $productos = Producto::all();
        return view('productos.inventario', compact('productos'));
    }

    // ✅ Listar productos con búsqueda
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', '%' . $search . '%')
                  ->orWhere('codigo', 'like', '%' . $search . '%')
                  ->orWhere('descripcion', 'like', '%' . $search . '%');
            });
        }

        $productos = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('productos.index', compact('productos'));
    }

    // ✅ Formulario crear producto
    public function create()
    {
        return view('productos.create');
    }

    // ✅ Guardar producto CON CÓDIGO AUTOMÁTICO
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
            // 'codigo' REMOVIDO - se genera automáticamente
        ]);

        // Generar código automáticamente
        $codigo = 'PROD-' . strtoupper(uniqid());

        Producto::create([
            'nombre' => $request->nombre,
            'codigo' => $codigo,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('productos.index')->with('success', '✅ Producto creado correctamente. Código: ' . $codigo);
    }

    // ✅ Mostrar un producto
    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    // ✅ Editar producto
    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    // ✅ Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:100|unique:productos,codigo,' . $producto->id,
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
        ]);

        $producto->update([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('productos.index')->with('success', '✅ Producto actualizado correctamente.');
    }

    // ✅ Eliminar producto
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index')->with('success', '🗑️ Producto eliminado correctamente.');
    }

    // ✅ Exportar productos a PDF
    public function exportarPDF()
    {
        $productos = Producto::orderBy('nombre')->get();
        $pdf = PDF::loadView('productos.pdf', compact('productos'));
        return $pdf->download('reporte_productos_' . date('Y-m-d') . '.pdf');
    }

    // ✅ Exportar inventario a PDF
    public function exportarInventarioPDF()
    {
        $productos = Producto::orderBy('nombre')->get();
        $pdf = PDF::loadView('productos.inventario-pdf', compact('productos'));
        return $pdf->download('inventario_' . date('Y-m-d') . '.pdf');
    }

    // ✅ Buscar productos (para AJAX)
    public function buscar(Request $request)
    {
        $search = $request->get('search');

        $productos = Producto::where('nombre', 'like', '%' . $search . '%')
                            ->orWhere('codigo', 'like', '%' . $search . '%')
                            ->limit(10)
                            ->get();

        return response()->json($productos);
    }

    // ✅ Obtener producto por código (para AJAX)
    public function porCodigo($codigo)
    {
        $producto = Producto::where('codigo', $codigo)->first();

        if ($producto) {
            return response()->json($producto);
        }

        return response()->json(['error' => 'Producto no encontrado'], 404);
    }
}
