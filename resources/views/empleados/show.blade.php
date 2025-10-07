@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-dark">
            <h2 class="mb-0">✏ Editar Empleado: {{ $empleado->nombre }} {{ $empleado->apellido }}</h2>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- IMPORTANTE: enctype="multipart/form-data" para subir archivos --}}
            <form action="{{ route('empleados.update', $empleado->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-8">
                        {{-- Detalles del Empleado --}}
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', $empleado->apellido) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="cargo" class="form-label">Cargo/Puesto</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo', $empleado->cargo) }}">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $empleado->telefono) }}">
                        </div>
                    </div>

                    {{-- Sección de la Foto --}}
                    <div class="col-md-4 text-center">
                        <label class="form-label d-block">Foto Actual</label>
                        @if ($empleado->foto_path)
                            <img 
                                src="{{ asset('storage/' . $empleado->foto_path) }}" 
                                alt="Foto Actual" 
                                class="img-fluid rounded-circle border border-2 mb-3" 
                                style="width: 150px; height: 150px; object-fit: cover;"
                            >
                        @else
                            <div class="bg-light p-4 rounded-circle mx-auto d-flex align-items-center justify-content-center border mb-3" style="width: 150px; height: 150px;">
                                <span class="text-muted">No Foto</span>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="foto_path" class="form-label">Cambiar Foto (Opcional)</label>
                            <input type="file" class="form-control" id="foto_path" name="foto_path" accept="image/*">
                            <small class="form-text text-muted">La foto anterior será reemplazada.</small>
                        </div>
                    </div>
                </div> {{-- /row --}}
                
                <hr>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Volver al Listado</a>
                    <button type="submit" class="btn btn-warning">💾 Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
