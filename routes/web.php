<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Statistics\DemographController;
use App\Http\Controllers\Statistics\SocialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('statistics')->group(function () {
        Route::get('/demograph', [DemographController::class, 'index'])->name('dashboard.statistics.demograph');
        Route::get('/social', [SocialController::class, 'index'])->name('dashboard.statistics.social');
    });
})->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
