@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detalles del Producto</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $producto->id }}</li>
        <li class="list-group-item"><strong>Nombre:</strong> {{ $producto->nombre }}</li>
        <li class="list-group-item"><strong>Descripción:</strong> {{ $producto->descripcion }}</li>
        <li class="list-group-item"><strong>Cantidad:</strong> {{ $producto->cantidad }}</li>
        <li class="list-group-item"><strong>Precio:</strong> ${{ number_format($producto->precio, 2) }}</li>
    </ul>

    <div class="mt-3">
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">↩ Volver</a>
    </div>
</div>
@endsection
