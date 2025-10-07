@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="max-w-xl mx-auto">
        
        {{-- Encabezado (Solo Título) --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Crear Nuevo Empleado</h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 shadow-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-xl">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150" value="{{ old('nombre') }}" required>
                </div>

                {{-- Apellido --}}
                <div class="mb-4">
                    <label for="apellido" class="block text-gray-700 text-sm font-bold mb-2">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150" value="{{ old('apellido') }}" required>
                </div>

                {{-- Cargo/Puesto --}}
                <div class="mb-4">
                    <label for="cargo" class="block text-gray-700 text-sm font-bold mb-2">Cargo/Puesto:</label>
                    <input type="text" name="cargo" id="cargo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150" value="{{ old('cargo') }}">
                </div>

                {{-- Teléfono --}}
                <div class="mb-4">
                    <label for="telefono" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150" value="{{ old('telefono') }}">
                </div>

                {{-- Foto de Perfil --}}
                <div class="mb-4 col-span-full">
                    <label for="foto_path" class="block text-gray-700 text-sm font-bold mb-2">Foto de Perfil:</label>
                    <input type="file" name="foto_path" id="foto_path" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

            </div>

            {{-- BOTONES GRANDES Y ALINEADOS CON MAYOR ÉNFASIS --}}
            <div class="flex justify-end mt-6 space-x-4">
                
                {{-- Botón de Regreso (Gris) --}}
                <a href="{{ route('empleados.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded shadow-md hover:shadow-lg transition duration-150 ease-in-out text-lg">
                    Volver al Listado
                </a>
                
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-lg hover:shadow-xl transition duration-150 ease-in-out text-lg">
                    Guardar Empleado
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
