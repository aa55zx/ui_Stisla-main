<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación de Laravel (login, register, password reset, etc.)
Auth::routes();

// ─── Dashboards por rol (protegidos con auth) ─────────────────────────────
Route::middleware(['auth'])->group(function () {

    Route::get('/alumno/dashboard', function () {
        return view('home'); // reemplaza con tu vista de alumno cuando la tengas
    })->name('alumno.dashboard');

    Route::get('/instructor/dashboard', function () {
        return view('home'); // reemplaza con tu vista de instructor cuando la tengas
    })->name('instructor.dashboard');

    Route::get('/admin/dashboard', function () {
        return view('home'); // reemplaza con tu vista de admin cuando la tengas
    })->name('admin.dashboard');

    // Rutas existentes del proyecto
    Route::resource('roles',    RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs',    BlogController::class);
});
