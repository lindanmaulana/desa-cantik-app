<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Statistics\DemographController;
use App\Http\Controllers\Statistics\SocialController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('statistics')->group(function () {
            Route::get('/demograph', [DemographController::class, 'index'])->name('dashboard.statistics.demograph');
            Route::get('/social', [SocialController::class, 'index'])->name('dashboard.statistics.social');
        });
    });
});
