<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Productos
    Route::resource('productos', ProductoController::class);
    Route::get('/productos/exportar/pdf', [ProductoController::class, 'exportarPDF'])->name('productos.pdf');

    // ✅ Ruta del inventario general (correcta)
    Route::get('/inventario', [ProductoController::class, 'inventario'])->name('productos.inventario');

    // Empleados
    Route::resource('empleados', EmpleadoController::class);

    // Ventas
    Route::resource('ventas', VentaController::class);
    Route::get('/ventas/pdf', [VentaController::class, 'generarPDF'])->name('ventas.pdf');
});

require __DIR__.'/auth.php';
