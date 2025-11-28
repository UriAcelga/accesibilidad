<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeguimientoController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'prevent-back'])->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/seguimiento/{id}', [SeguimientoController::class, 'index'])->name('seguimiento');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/solicitud', [HomeController::class, 'solicitudes'])->name('solicitud');
    Route::post('/solicitud', [EstudianteController::class, 'crear'])->name('solicitud');
    Route::post('/seguimiento/actualizar/{id}', [SeguimientoController::class, 'actualizar'])->name('actualizar');
    Route::post('/seguimiento/cerrar/{id}', [SeguimientoController::class, 'cerrar'])->name('cerrar');
    Route::get('/seguimiento/descargar/{id}', [SeguimientoController::class, 'descargar'])->name('descargar');
});

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/registro', [HomeController::class, 'registro'])->name('registro');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
