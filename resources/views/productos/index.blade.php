@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Listado de Productos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">➕ Nuevo Producto</a>

    <table class="table table-bordered table-striped">
        <thead>
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
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>
                        <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay productos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
