<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/registro', [HomeController::class, 'registro'])->name('registro');
Route::get('/solicitud', [HomeController::class, 'solicitudes'])->name('solicitud')->middleware('auth');

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
