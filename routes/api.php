<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\SettingsController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

// Aktifin middleware auth:sanctum
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Profile/Settings routes
    Route::resource('/profile', SettingsController::class);

});