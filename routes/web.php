<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Statistics\DemographController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->group(function () {
    Route::prefix('statistics')->group(function () {
        Route::get('/demograph', [DemographController::class, 'index'])->name('dashboard.statistics.demograph');
    });
});
