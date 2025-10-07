<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController; // 👈 NECESARIO: Importar el controlador de Empleados
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD productos
    Route::resource('productos', ProductoController::class);

    // Exportar PDF con filtros (ruta específica)
    Route::get('/productos/exportar/pdf', [ProductoController::class, 'exportarPDF'])->name('productos.pdf');
    
    // CRUD Empleados (Esto crea la ruta 'empleados.index')
    Route::resource('empleados', EmpleadoController::class);
});

require __DIR__.'/auth.php';
