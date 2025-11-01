<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\VentaController; // 👈 nuevo
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD de productos
    Route::resource('productos', ProductoController::class);
    Route::get('/productos/exportar/pdf', [ProductoController::class, 'exportarPDF'])->name('productos.pdf');

    // CRUD de empleados
    Route::resource('empleados', EmpleadoController::class);

    // 👇 NUEVO: módulo de ventas
    Route::resource('ventas', VentaController::class);

    // (Opcional) si luego quieres exportar las ventas a PDF o Excel
    // Route::get('/ventas/exportar/pdf', [VentaController::class, 'exportarPDF'])->name('ventas.pdf');
});

require __DIR__.'/auth.php';
