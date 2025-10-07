@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Empleado: {{ $empleado->nombre }} {{ $empleado->apellido }}</h2>
    
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
    
    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empleado->nombre) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido', $empleado->apellido) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo (Puesto):</label>
            <input type="text" name="cargo" id="cargo" class="form-control" value="{{ old('cargo', $empleado->cargo) }}">
        </div>
        
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $empleado->telefono) }}">
        </div>
        
        <button type="submit" class="btn btn-warning">💾 Actualizar Empleado</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">↩ Volver al Listado</a>
    </form>
</div>
@endsection
