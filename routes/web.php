<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\DemographClientController;
use App\Http\Controllers\Client\EconomyClientController;
use App\Http\Controllers\Client\InfrastructureClientController;
use App\Http\Controllers\Client\MsmeClientController;
use App\Http\Controllers\Client\SocialClientController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';

Route::prefix('/')->group(function () {
  Route::get('/', [ClientController::class, 'index'])->name('home');
  Route::prefix('statistik')->group(function () {
    Route::get('demograph', [DemographClientController::class, 'index'])->name('statistik.demografi');
    Route::get('social', [SocialClientController::class, 'index'])->name('statistik.social');
    Route::get('economy', [EconomyClientController::class, 'index'])->name('statistik.economy');
    Route::get('msme', [MsmeClientController::class, 'index'])->name('statistik.msme');
    Route::get('infrastructure', [InfrastructureClientController::class, 'index'])->name('statistik.infrastructure');
    Route::get('spacial-data', [ClientController::class, 'spacialData'])->name('statistik.spacial-data');
    Route::get('analisis-data', [ClientController::class, 'analisis'])->name('analisis');
  });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
