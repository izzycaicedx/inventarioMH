@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Listado de Empleados</h2>
    
    {{-- Muestra mensaje de éxito después de una creación, edición o eliminación --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    {{-- Botón para ir al formulario de creación --}}
    <a href="{{ route('empleados.create') }}" class="btn btn-primary mb-3">➕ Nuevo Empleado</a>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cargo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Itera sobre la colección de empleados que viene del controlador --}}
            @forelse($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->apellido }}</td>
                    <td>{{ $empleado->cargo }}</td>
                    <td>{{ $empleado->telefono }}</td>
                    <td>
                        {{-- Botones de Acciones --}}
                        <a href="{{ route('empleados.show', $empleado->id) }}" class="btn btn-info btn-sm">👁 Ver</a>
                        <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">✏ Editar</a>
                        
                        {{-- Formulario para eliminar (usa el método DELETE) --}}
                        <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar a este empleado?')">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay empleados registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
```eof

---

### Lo que hace este código:

1.  **Extends Layout:** Usa tu plantilla principal (`layouts.app`) para aplicar el menú y los estilos de Bootstrap.
2.  **Título y Botón:** Muestra el título "Listado de Empleados" y el botón "➕ Nuevo Empleado" que apunta a la ruta `empleados.create`.
3.  **Tabla:** Define la estructura de la tabla con las columnas que diseñamos (Nombre, Apellido, Cargo, Teléfono).
4.  **Loop (`@forelse`):** Itera sobre la variable `$empleados` que debe ser enviada por el `EmpleadoController`.
5.  **Acciones CRUD:** Incluye botones para **Ver**, **Editar** y un formulario para **Eliminar** (que usa el método `DELETE` requerido por Laravel para rutas de recursos).

### Siguiente Paso

Ahora, al hacer clic en el botón **Empleados**, deberías ver esta tabla. El siguiente paso lógico será hacer clic en **"➕ Nuevo Empleado"**. ¿Te gustaría que te dé el código del formulario de creación (`create.blade.php`) para que puedas registrar tu primer empleado?