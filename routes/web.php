<?php

use App\Http\Controllers\Client\DemographController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';

Route::prefix('/')->group(function () {
  Route::get('/', function () {
    return view('index');
  })->name('home');

  Route::prefix('statistik')->group(function () {
    Route::get('demografi', [DemographController::class, 'index'])->name('statistik.demografi');
    Route::get('social', [DemographController::class, 'index'])->name('statistik.social');
    Route::get('economy', [DemographController::class, 'index'])->name('statistik.economy');
    Route::get('msme', [DemographController::class, 'index'])->name('statistik.msme');
    Route::get('infrastructure', [DemographController::class, 'index'])->name('statistik.infrastructure');
    Route::get('spacial-data', [DemographController::class, 'index'])->name('statistik.spacial-data');
  });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
