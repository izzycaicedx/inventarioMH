<?php

namespace App\Http\Controllers;

use App\Models\Empleado; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::all();
        
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'foto_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        
        $data = $request->except('foto_path');

        if ($request->hasFile('foto_path')) {
            $path = $request->file('foto_path')->store('empleados', 'public');
            $data['foto_path'] = $path;
        }
        
        Empleado::create($data);

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado agregado exitosamente!');
    }

    public function show(Empleado $empleado)
    {
        return view('empleados.show', compact('empleado'));
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cargo' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'foto_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $data = $request->except('foto_path');

        if ($request->hasFile('foto_path')) {
            
            if ($empleado->foto_path) {
                Storage::disk('public')->delete($empleado->foto_path);
            }

            $path = $request->file('foto_path')->store('empleados', 'public');
            $data['foto_path'] = $path;
        }

        $empleado->update($data);

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado actualizado exitosamente!');
    }

    public function destroy(Empleado $empleado)
    {
        if ($empleado->foto_path) {
            Storage::disk('public')->delete($empleado->foto_path);
        }

        $empleado->delete();

        return redirect()->route('empleados.index')
                         ->with('success', '¡Empleado eliminado correctamente!');
    }
}
