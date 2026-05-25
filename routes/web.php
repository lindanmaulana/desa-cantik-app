<?php

use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';

Route::prefix('/')->group(function () {
  Route::get('/', [ClientController::class, 'index'])->name('home');
  Route::prefix('statistik')->group(function () {
    Route::get('demograph', [ClientController::class, 'demograph'])->name('statistik.demografi');
    Route::get('social', [ClientController::class, 'social'])->name('statistik.social');
    Route::get('economy', [ClientController::class, 'economy'])->name('statistik.economy');
    Route::get('msme', [ClientController::class, 'msme'])->name('statistik.msme');
    Route::get('infrastructure', [ClientController::class, 'infrastructure'])->name('statistik.infrastructure');
    Route::get('spacial-data', [ClientController::class, 'spacialData'])->name('statistik.spacial-data');
  });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
