<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\Statistics\DemographController;
use App\Http\Controllers\Dashboard\Statistics\EconomyController;
use App\Http\Controllers\Dashboard\Statistics\InfrastructureController;
use App\Http\Controllers\Dashboard\Statistics\MsmeController;
use App\Http\Controllers\Dashboard\Statistics\SocialController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::prefix('statistics')->group(function () {
            Route::get('/demograph', [DemographController::class, 'index'])->name('dashboard.statistics.demograph');
            Route::get('/social', [SocialController::class, 'index'])->name('dashboard.statistics.social');
            Route::get('/economy', [EconomyController::class, 'index'])->name('dashboard.statistics.economy');
            Route::get('/msme', [MsmeController::class, 'index'])->name('dashboard.statistics.msme');
            Route::get('/infrastructure', [InfrastructureController::class, 'index'])->name('dashboard.statistics.infrastructure');
        });
    });
});
