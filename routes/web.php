<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\DocumentacionController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\DeduccionController;
use App\Http\Controllers\DashboardController;

Auth::routes(['register' => false]); // Desactiva registro si no es necesario




Route::get('nominas/pdf', [NominaController::class, 'pdf'])->name('nominas.pdf');

Route::get('nominas/voucher/{id}', [NominaController::class, 'voucher'])->name('nominas.voucher');



// Ruta principal del sitio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Redirección para cualquier intento de acceso a /register
Route::get('/register', function() {
    return redirect('/login');
});

// Grupo de rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Ruta del dashboard después del login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Rutas para Empleados
    Route::resource('empleados', EmpleadosController::class);
    Route::get('/empleados/{id}/edit', [EmpleadosController::class, 'edit'])->name('empleados.edit');
    Route::put('/empleados/{id}', [EmpleadosController::class, 'update'])->name('empleados.update');

    // Rutas para Puestos
    Route::resource('puestos', PuestoController::class);

    // Rutas para Documentación
    Route::resource('documentaciones', DocumentacionController::class);
    Route::get('/documentaciones/{id}', [DocumentacionController::class, 'show'])->name('documentaciones.show');

    // Rutas para Nóminas
    Route::resource('nominas', NominaController::class);
   

    // Rutas para Deducciones
    Route::resource('deducciones', DeduccionController::class);

    // Ruta protegida del administrador
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

// Ruta para manejar URLs no encontradas
Route::fallback(function () {
    return redirect()->route('dashboard.index')->with('error', 'Página no encontrada');
});
