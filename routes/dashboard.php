<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ManageData\TerritoriesController;
use App\Http\Controllers\Dashboard\PandawaAnalysisController;
use App\Http\Controllers\Dashboard\Statistics\DemographController;
use App\Http\Controllers\Dashboard\Statistics\EconomyController;
use App\Http\Controllers\Dashboard\Statistics\InfrastructureController;
use App\Http\Controllers\Dashboard\Statistics\MsmeController;
use App\Http\Controllers\Dashboard\Statistics\SocialController;
use App\Http\Controllers\Dashboard\Statistics\SpatialDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ManageData\FamiliesController;
use App\Http\Controllers\Dashboard\ManageData\CitizensController;

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::prefix('statistics')->group(function () {
            Route::get('/demograph', [DemographController::class, 'index'])->name('dashboard.statistics.demograph');
            Route::get('/social', [SocialController::class, 'index'])->name('dashboard.statistics.social');
            Route::get('/economy', [EconomyController::class, 'index'])->name('dashboard.statistics.economy');
            Route::get('/msme', [MsmeController::class, 'index'])->name('dashboard.statistics.msme');
            Route::get('/infrastructure', [InfrastructureController::class, 'index'])->name('dashboard.statistics.infrastructure');
            Route::get('/spatial-data', [SpatialDataController::class, 'index'])->name('dashboard.statistics.spatial-data');
        });

        Route::prefix('manage-data')->group(function () {
            Route::prefix('territories')->group(function () {
                Route::get('/', [TerritoriesController::class, 'index'])->name('dashboard.manage-data.territories');
                Route::post('/store', [TerritoriesController::class, 'store'])->name('territories.store');
                Route::put('/{territory}/update', [TerritoriesController::class, 'update'])->name('territories.update');
                Route::delete('/{territory}', [TerritoriesController::class, 'destroy'])->name('territories.destroy');
            });

            Route::prefix('families')->group(function () {
                Route::get('/', [FamiliesController::class, 'index'])->name('dashboard.manage-data.families');
                Route::post('/store', [FamiliesController::class, 'store'])->name('families.store');
                Route::put('/{family}/update', [FamiliesController::class, 'update'])->name('families.update');
                Route::delete('/{family}', [FamiliesController::class, 'destroy'])->name('families.destroy');
            });

            Route::prefix('citizens')->group(function () {
                Route::get('/', [CitizensController::class, 'index'])->name('dashboard.manage-data.citizens');
                Route::post('/store', [CitizensController::class, 'store'])->name('citizens.store');
                Route::put('/{citizen}/update', [CitizensController::class, 'update'])->name('citizens.update');
                Route::delete('/{citizen}', [CitizensController::class, 'destroy'])->name('citizens.destroy');
            });
        });

        Route::get("/pandawa-analysis", [PandawaAnalysisController::class, 'index'])->name('dashboard.pandawa-analysis');
    });
});
