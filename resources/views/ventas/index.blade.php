@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Lista de Ventas</h1>
        <div>
            <a href="{{ route('ventas.pdf') }}" class="btn btn-danger">
                <i class="bi bi-file-pdf"></i> Generar PDF
            </a>
            <a href="{{ route('ventas.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Nueva Venta
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Total</th>
                            <th>Método Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>
                                @if($venta->fecha instanceof \Carbon\Carbon)
                                    {{ $venta->fecha->format('d/m/Y H:i') }}
                                @else
                                    {{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}
                                @endif
                            </td>
                            <td>{{ $venta->usuario->name ?? 'N/A' }}</td>
                            <td>${{ number_format($venta->total, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $venta->metodo_pago == 'Efectivo' ? 'success' : ($venta->metodo_pago == 'Tarjeta' ? 'primary' : 'warning') }}">
                                    {{ $venta->metodo_pago }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('ventas.show', $venta) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('ventas.destroy', $venta) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar esta venta?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-receipt display-4 d-block mb-2"></i>
                                No hay ventas registradas
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
