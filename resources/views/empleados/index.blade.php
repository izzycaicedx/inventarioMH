@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Listado de Empleados</h2>

    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">➕ Nuevo Empleado</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->telefono }}</td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este empleado?')">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No hay empleados registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
