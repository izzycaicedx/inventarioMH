@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Producto</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>⚠ Ocurrieron algunos errores:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ $producto->nombre }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción:</label>
            <input type="text" name="descripcion" value="{{ $producto->descripcion }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Cantidad:</label>
            <input type="number" name="cantidad" value="{{ $producto->cantidad }}" class="form-control" required min="0">
        </div>

        <div class="mb-3">
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}" class="form-control" required min="0">
        </div>

        <button type="submit" class="btn btn-primary">💾 Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">↩ Volver</a>
    </form>
</div>
@endsection
