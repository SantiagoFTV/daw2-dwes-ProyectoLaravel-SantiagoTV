<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuloController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;

// Ruta pública
Route::get('/', [BuloController::class, 'index']);

// Rutas para invitados (guest middleware)
Route::view('/register', 'auth.register')
    ->middleware('guest')
    ->name('register');

Route::post('/register', Register::class)
    ->middleware('guest');

Route::view('/login', 'auth.login')
    ->middleware('guest')
    ->name('login');

Route::post('/login', Login::class)
    ->middleware('guest');

// Ruta para logout (solo autenticados)
Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');

// Rutas protegidas (solo autenticados)
Route::middleware('auth')->group(function () {
    Route::post('/bulos', [BuloController::class, 'store']);
    Route::get('/bulos/{bulo}/edit', [BuloController::class, 'edit']);
    Route::put('/bulos/{bulo}', [BuloController::class, 'update']);
    Route::delete('/bulos/{bulo}', [BuloController::class, 'destroy']);
});
