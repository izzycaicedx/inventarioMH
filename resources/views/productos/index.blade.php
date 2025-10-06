@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3 text-center">📦 Listado de Productos</h2>

    {{-- ✅ Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 🔍 Filtros de búsqueda --}}
    <form action="{{ route('productos.index') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-3">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por nombre o descripción" value="{{ request('busqueda') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="precio_min" class="form-control" placeholder="Precio mínimo" value="{{ request('precio_min') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="precio_max" class="form-control" placeholder="Precio máximo" value="{{ request('precio_max') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="cantidad_min" class="form-control" placeholder="Cantidad mínima" value="{{ request('cantidad_min') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="cantidad_max" class="form-control" placeholder="Cantidad máxima" value="{{ request('cantidad_max') }}">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100">🔎</button>
        </div>
    </form>

    {{-- 📄 Exportar PDF + ➕ Crear producto --}}
    <div class="d-flex justify-content-between mb-3">
        <form method="GET" action="{{ route('productos.pdf') }}" target="_blank">
            <input type="hidden" name="busqueda" value="{{ request('busqueda') }}">
            <input type="hidden" name="precio_min" value="{{ request('precio_min') }}">
            <input type="hidden" name="precio_max" value="{{ request('precio_max') }}">
            <input type="hidden" name="cantidad_min" value="{{ request('cantidad_min') }}">
            <input type="hidden" name="cantidad_max" value="{{ request('cantidad_max') }}">
            <button type="submit" class="btn btn-success">📄 Exportar PDF</button>
        </form>

        <a href="{{ route('productos.create') }}" class="btn btn-primary">➕ Nuevo Producto</a>
    </div>

    {{-- 📋 Tabla de productos --}}
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td class="text-center">{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td class="text-center">{{ $producto->cantidad }}</td>
                    <td class="text-end">${{ number_format($producto->precio, 2) }}</td>
                    <td class="text-center">
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 🔢 Paginación --}}
    <div class="d-flex justify-content-center">
        {{ $productos->links() }}
    </div>
</div>
@endsection
