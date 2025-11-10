@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📦 Inventario General</h2>

    @if($productos->isEmpty())
        <div class="alert alert-warning">No hay productos registrados en el inventario.</div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->codigo }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>{{ $producto->descripcion ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
