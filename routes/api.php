<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AlertController;
use Illuminate\Support\Facades\Route;

// Rutas públicas de autenticación
Route::post('/auth/login', [AuthController::class, 'login']);

// Ruta de alertas para pruebas (sin autenticación)
Route::apiResource('alerts', AlertController::class);

// Rutas protegidas que requieren autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Comentamos la ruta protegida para evitar conflictos durante las pruebas
    // Route::apiResource('alerts', AlertController::class);
});
