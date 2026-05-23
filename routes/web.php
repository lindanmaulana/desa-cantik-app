<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';

Route::prefix('/')->group(function () {
  Route::get('/', function () {
    return view('index');
  })->name('home');

  Route::prefix('statistik')->group(function () {
    Route::get('demografi', function () {
      return view('user_pages.demografi');
    })->name('statistik.demografi');

    Route::get('social', function () {
      return view('user_pages.social');
    })->name('statistik.social');

    Route::get('economy', function () {
      return view('user_pages.economy');
    })->name('statistik.economy');

    Route::get('msme', function () {
      return view('user_pages.msme');
    })->name('statistik.msme');

    Route::get('infrastructure', function () {
      return view('user_pages.infrastructure');
    })->name('statistik.infrastructure');

    Route::get('spacial-data', function () {
      return view('user_pages.spacial-data');
    })->name('statistik.spacial-data');
  });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
