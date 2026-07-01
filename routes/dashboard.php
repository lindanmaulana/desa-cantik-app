<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ManageData\ChildGrowthLogsController;
use App\Http\Controllers\Dashboard\ManageData\TerritoriesController;
use App\Http\Controllers\Dashboard\PandawaAnalysisController;
use App\Http\Controllers\Dashboard\Statistics\DemographController;
use App\Http\Controllers\Dashboard\Statistics\InfrastructureController;
use App\Http\Controllers\Dashboard\Statistics\MsmeController;
use App\Http\Controllers\Dashboard\Statistics\SocialController;
use App\Http\Controllers\Dashboard\Statistics\SpatialDataController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ManageData\FamiliesController;
use App\Http\Controllers\Dashboard\ManageData\CitizensController;
use App\Http\Controllers\Dashboard\ManageData\EducationProfileController;
use App\Http\Controllers\Dashboard\ManageData\EmploymentProfileController;
use App\Http\Controllers\Dashboard\ManageData\HealthProfileController;
use App\Http\Controllers\Dashboard\ManageData\HousingProfileController;
use App\Http\Controllers\Dashboard\ManageData\MsmesController;
use App\Http\Controllers\Dashboard\ManageData\InfrastructuresController;
use App\Http\Controllers\Dashboard\ManageData\SpatialDataController as ManageSpatialDataController;
use App\Http\Controllers\Dashboard\Settings\VillageSettingController;
use App\Http\Controllers\Dashboard\Statistics\EconomicController;
use App\Http\Controllers\Dashboard\Statistics\HealthController;
use App\Http\Controllers\Dashboard\Admin\ManageOperatorController;

Route::middleware(['auth'])->group(function () {
  Route::prefix('dashboard')->group(function () {
    Route::middleware(['role:admin,operator'])->group(function () {
      Route::get('/', [HomeController::class, 'index'])->name('dashboard');

      Route::prefix('statistics')->group(function () {
        Route::get('/demograph', [DemographController::class, 'index'])->name('dashboard.statistics.demograph');
        Route::get('/social', [SocialController::class, 'index'])->name('dashboard.statistics.social');
        Route::get('/health', [HealthController::class, 'index'])->name('dashboard.statistics.health');
        Route::get('/economic', [EconomicController::class, 'index'])->name('dashboard.statistics.economic');
        Route::get('/msme', [MsmeController::class, 'index'])->name('dashboard.statistics.msme');
        Route::get('/infrastructure', [InfrastructureController::class, 'index'])->name('dashboard.statistics.infrastructure');
        Route::get('/spatial-data', [SpatialDataController::class, 'index'])->name('dashboard.statistics.spatial-data');
      });

      Route::prefix('manage-data')->group(function () {
        Route::prefix('territories')->group(function () {
          Route::get('/', [TerritoriesController::class, 'index'])->name('dashboard.manage-data.territories');
          Route::post('/store', [TerritoriesController::class, 'store'])->name('territories.store');
          Route::put('/{territory}/update', [TerritoriesController::class, 'update'])->name('territories.update');
          Route::delete('/{territory}/destroy', [TerritoriesController::class, 'destroy'])->name('territories.destroy');
        });

        Route::prefix('families')->group(function () {
          Route::get('/', [FamiliesController::class, 'index'])->name('dashboard.manage-data.families');
          Route::get('/families/{family}/detail', [FamiliesController::class, 'show'])->name('dashboard.manage-data.families.detail');
          Route::post('/store', [FamiliesController::class, 'store'])->name('families.store');
          Route::put('/{family}/update', [FamiliesController::class, 'update'])->name('families.update');
          Route::delete('/{family}', [FamiliesController::class, 'destroy'])->name('families.destroy');
        });

        Route::prefix('housing-profile')->group(function () {
          Route::post('/{family}/store', [HousingProfileController::class, 'store'])->name('housing-profile.store');
          Route::put('/{family}/update', [HousingProfileController::class, 'update'])->name('housing-profile.update');
        });

        Route::prefix('citizens')->group(function () {
          Route::get('/', [CitizensController::class, 'index'])->name('dashboard.manage-data.citizens');
          Route::get('/{citizen}/detail', [CitizensController::class, 'show'])->name('dashboard.manage-data.citizens.detail');

          Route::post('/store', [CitizensController::class, 'store'])->name('citizens.store');
          Route::put('/{citizen}/update', [CitizensController::class, 'update'])->name('citizens.update');
          Route::delete('/{citizen}', [CitizensController::class, 'destroy'])->name('citizens.destroy');
        });

        Route::prefix('health-profile')->group(function () {
          Route::post('/{citizen}/store', [HealthProfileController::class, 'store'])->name('health-profile.store');
          Route::put('/{citizen}/update', [HealthProfileController::class, 'update'])->name('health-profile.update');
        });

        Route::prefix('education-profile')->group(function () {
          Route::post('/{citizen}/store', [EducationProfileController::class, 'store'])->name('education-profile.store');
          Route::put('/{citizen}/update', [EducationProfileController::class, 'update'])->name('education-profile.update');
        });

        Route::prefix('employment-profile')->group(function () {
          Route::post('/{citizen}/store', [EmploymentProfileController::class, 'store'])->name('employment-profile.store');
          Route::put('/{citizen}/update', [EmploymentProfileController::class, 'update'])->name('employment-profile.update');
        });

        Route::prefix('child-growth-logs')->group(function () {
          Route::post('/{citizen}/store', [ChildGrowthLogsController::class, 'store'])->name('child-growth-logs.store');
          Route::put('/{citizen}/update', [ChildGrowthLogsController::class, 'update'])->name('child-growth-logs.update');
        });

        Route::prefix('msmes')->group(function () {
          Route::get('/', [MsmesController::class, 'index'])->name('dashboard.manage-data.msmes');
          Route::post('/store', [MsmesController::class, 'store'])->name('msmes.store');
          Route::put('/{msme}/update', [MsmesController::class, 'update'])->name('msmes.update');
          Route::delete('/{msme}', [MsmesController::class, 'destroy'])->name('msmes.destroy');
        });

        Route::prefix('infrastructures')->group(function () {
          Route::get('/', [InfrastructuresController::class, 'index'])->name('dashboard.manage-data.infrastructures');
          Route::post('/store', [InfrastructuresController::class, 'store'])->name('infrastructures.store');
          Route::put('/{infrastructure}/update', [InfrastructuresController::class, 'update'])->name('infrastructures.update');
          Route::delete('/{infrastructure}', [InfrastructuresController::class, 'destroy'])->name('infrastructures.destroy');
        });

        Route::prefix('spatial-data')->group(function () {
          Route::get('/', [ManageSpatialDataController::class, 'index'])->name('dashboard.manage-data.spatial-data');
          Route::post('/store', [ManageSpatialDataController::class, 'store'])->name('spatial-data.store');
          Route::put('/{spatial_data}/update', [ManageSpatialDataController::class, 'update'])->name('spatial-data.update');
          Route::delete('/{spatial_data}', [ManageSpatialDataController::class, 'destroy'])->name('spatial-data.destroy');
        });
      });

      Route::get("/pandawa-analysis", [PandawaAnalysisController::class, 'index'])->name('dashboard.pandawa-analysis');
    });

    Route::middleware(['role:admin'])->group(function () {
      Route::prefix('settings')->group(function () {
        Route::get('/', [VillageSettingController::class, 'index'])->name('dashboard.settings.index');
        Route::post('/store', [VillageSettingController::class, 'store'])->name('settings.store');
        Route::put('/update', [VillageSettingController::class, 'update'])->name('settings.update');
        Route::put('/update-logo', [VillageSettingController::class, 'updateLogo'])->name('settings.update-logo');
        Route::put('/update-banner', [VillageSettingController::class, 'updateBanner'])->name('settings.update-banner');
      });

      Route::prefix('manage-operators')->group(function () {
        Route::get('/', [ManageOperatorController::class, 'index'])->name('dashboard.admin.manage-operator.index');
        Route::post('/store', [ManageOperatorController::class, 'store'])->name('admin.manage-operator.store');
        Route::put('/{operator}/update', [ManageOperatorController::class, 'update'])->name('admin.manage-operator.update');
        Route::delete('/{operator}', [ManageOperatorController::class, 'destroy'])->name('admin.manage-operator.destroy');
      });
    });
  });
});
