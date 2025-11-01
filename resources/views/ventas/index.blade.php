@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Listado de Ventas</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('ventas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Venta
        </a>
    </div>

    @if ($ventas->isEmpty())
        <div class="alert alert-info text-center">
            No hay ventas registradas aún.
        </div>
    @else
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Total</th>
                    <th>Método de Pago</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->fecha }}</td>
                        <td>{{ $venta->usuario->name ?? 'Sin usuario' }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                        <td>{{ $venta->metodo_pago ?? 'No especificado' }}</td>
                        <td>
                            <a href="{{ route('ventas.show', $venta) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form action="{{ route('ventas.destroy', $venta) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta venta?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
