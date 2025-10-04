<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController; // 👈 importar tu controlador
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard (protegido con login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 👇 Aquí agregamos el CRUD de productos
    Route::resource('productos', ProductoController::class);
});

require __DIR__.'/auth.php';
