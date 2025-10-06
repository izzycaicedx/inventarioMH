@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Agregar Producto</h2>

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

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción:</label>
            <input type="text" name="descripcion" class="form-control">
        </div>

        <div class="mb-3">
            <label>Cantidad:</label>
            <input type="number" name="cantidad" class="form-control" required min="0">
        </div>

        <div class="mb-3">
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" class="form-control" required min="0">
        </div>

        <button type="submit" class="btn btn-success">💾 Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">↩ Volver</a>
    </form>
</div>
@endsection
