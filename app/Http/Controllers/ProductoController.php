<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    // -----------------------------
    // MÉTODO PRIVADO DE FILTROS
    // -----------------------------
    private function aplicarFiltros($query, $request)
    {
        if ($request->filled('busqueda')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', "%{$request->busqueda}%")
                  ->orWhere('descripcion', 'like', "%{$request->busqueda}%");
            });
        }

        if ($request->filled('precio_min')) $query->where('precio', '>=', $request->precio_min);
        if ($request->filled('precio_max')) $query->where('precio', '<=', $request->precio_max);
        if ($request->filled('cantidad_min')) $query->where('cantidad', '>=', $request->cantidad_min);
        if ($request->filled('cantidad_max')) $query->where('cantidad', '<=', $request->cantidad_max);

        return $query;
    }

    // -----------------------------
    // INDEX CON FILTROS
    // -----------------------------
    public function index(Request $request)
    {
        $query = Producto::query();
        $this->aplicarFiltros($query, $request);

        $productos = $query->orderBy('nombre')->paginate(10)->withQueryString();

        return view('productos.index', [
            'productos' => $productos,
            'busqueda' => $request->busqueda,
            'precio_min' => $request->precio_min,
            'precio_max' => $request->precio_max,
            'cantidad_min' => $request->cantidad_min,
            'cantidad_max' => $request->cantidad_max,
        ]);
    }

    // -----------------------------
    // EXPORTAR PDF
    // -----------------------------
    public function exportarPDF(Request $request)
    {
        $query = Producto::query();
        $this->aplicarFiltros($query, $request);
        $productos = $query->orderBy('nombre')->get();

        $pdf = Pdf::loadView('productos.pdf', compact('productos'));
        return $pdf->download('productos_' . date('Ymd_His') . '.pdf');
    }

    // -----------------------------
    // CRUD BÁSICO
    // -----------------------------
    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'cantidad' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}

