<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SeguimientoController;

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'prevent-back'])->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/solicitud', [HomeController::class, 'solicitudes'])->name('solicitud');
    Route::get('/seguimiento/{id}', [SeguimientoController::class, 'index'])->name('solicitud');
});

Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/registro', [HomeController::class, 'registro'])->name('registro');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
