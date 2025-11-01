@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Listado de Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ventas.create') }}" class="btn btn-primary mb-3">➕ Nueva Venta</a>

    <table class="table table-bordered table-striped">
        <thead>
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
            @forelse($ventas as $venta)
                <tr>
                    <td>{{ $venta->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $venta->usuario?->name ?? 'N/A' }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>{{ $venta->metodo_pago ?? 'No especificado' }}</td>
                    <td>
                        <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                        <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>

                        <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar esta venta?')">
                                🗑 Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay ventas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
