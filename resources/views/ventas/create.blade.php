@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-center">Registrar Venta</h1>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="metodo_pago" class="form-label">Método de Pago</label>
            <select name="metodo_pago" id="metodo_pago" class="form-select" required>
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Transferencia">Transferencia</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Seleccionar Productos</label>
            @if ($productos->isEmpty())
                <p class="text-danger">⚠ No hay productos registrados en el inventario.</p>
            @else
                <div class="row">
                    @foreach ($productos as $producto)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                                    <p class="text-muted mb-1">Stock: {{ $producto->cantidad }}</p>
                                    <p class="text-muted mb-1">Precio: ${{ number_format($producto->precio, 2) }}</p>
                                    <input type="checkbox" name="productos[]" value="{{ $producto->id }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Guardar Venta
            </button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </form>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
