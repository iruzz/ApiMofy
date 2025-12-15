<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\PortofolioController;


Route::post('/login', [AuthController::class, 'login'])->name('login');

 Route::get('/', [SettingsController::class, 'index']);

 Route::get('/', [ServicesController::class, 'index']);
 Route::get('/layanan', [ServicesController::class, 'index']);

 Route::get('/', [PortofolioController::class, 'index']);
 Route::get('/portofolio', [PortofolioController::class, 'index']);

// Aktifin middleware auth:sanctum
Route::middleware(['auth:sanctum'])->prefix('admin')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Profile/Settings routes
    Route::resource('/profile', SettingsController::class);

    Route::resource('/layanan', ServicesController::class);

    Route::resource('/portofolio', PortofolioController::class);
    
    // HAPUS 1 GAMBAR (custom route)
       // HAPUS 1 GAMBAR
    Route::delete('portofolio/image/{id}', [PortofolioController::class, 'deleteImage']);

    // REORDER GAMBAR (POST)
    Route::post('portofolio/image/reorder', [PortofolioController::class, 'reorderImage']);


});