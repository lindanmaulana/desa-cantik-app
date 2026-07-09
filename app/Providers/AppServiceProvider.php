<?php

namespace App\Providers;

use App\Services\Admin\VillageSettingService;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(VillageSettingService $villageSettingService): void
    {
        if (config('app.env') === 'production' || env('FORCE_HTTPS', false)) {
            URL::forceScheme('https');
        }

        $settings = null;

        if (!app()->runningInConsole()) {
            try {
                $settings = $villageSettingService->getSettings();
            } catch (\Throwable $e) {
                Log::warning('Gagal memuat Village Settings pada boot: ' . $e->getMessage());
            }
        }

        if (!$settings) {
            $settings = new \App\Models\VillageSetting([
                'id' => (string) \Illuminate\Support\Str::uuid(),
                'village_name' => 'Nama Desa Belum Di-set',
                'village_code' => '000000',
                'subdistrict_name' => 'Kecamatan Belum Di-set',
                'regency_name' => 'Kabupaten Belum Di-set',
                'province_name' => 'Provinsi Belum Di-set',
                'app_title' => 'Web Desa',
            ]);
        }

        Relation::morphMap([
            'resident_house' => \App\Models\Citizen::class,
            'public_facility' => \App\Models\Infrastructure::class,
            'msme_location' => \App\Models\Msme::class,
        ]);

        View::share([
            // --- Data & Master Enums ---
            'bloodType' => \App\Enums\BloodType::class,
            'bpjsStatus' => \App\Enums\BpjsStatus::class,
            'bumdesPartnershipStatus' => \App\Enums\BumdesPartnershipStatus::class,
            'businessCategory' => \App\Enums\BusinessCategory::class,
            'conditionInfrastructure' => \App\Enums\ConditionInfrastructure::class,
            'cookingFuel' => \App\Enums\CookingFuel::class,
            'digitalPlatformType' => \App\Enums\DigitalPlatformType::class,
            'disabilityType' => \App\Enums\DisabilityType::class,
            'economicStatus' => \App\Enums\EconomicStatus::class,
            'educationLevel' => \App\Enums\EducationLevel::class,
            'electricityCapacity' => \App\Enums\ElectricityCapacity::class,
            'electricitySource' => \App\Enums\ElectricitySource::class,
            'employmentStatus' => \App\Enums\EmploymentStatus::class,
            'facilityType' => \App\Enums\FacilityType::class,
            'familyRole' => \App\Enums\FamilyRole::class,
            'floorMaterial' => \App\Enums\FloorMaterial::class,
            'featureType' => \App\Enums\FeatureType::class,
            'gender' => \App\Enums\Gender::class,
            'houseCondition' => \App\Enums\HouseCondition::class,
            'houseOwnership' => \App\Enums\HouseOwnership::class,
            'jobSector' => \App\Enums\JobSector::class,
            'kbMethod' => \App\Enums\KbMethod::class,
            'legalEntityType' => \App\Enums\LegalEntityType::class,
            'maritalStatus' => \App\Enums\MaritalStatus::class,
            'religion' => \App\Enums\Religion::class,
            'roofMaterial' => \App\Enums\RoofMaterial::class,
            'sanitationType' => \App\Enums\SanitationType::class,
            'schoolParticipation' => \App\Enums\SchoolParticipation::class,
            'stuntingStatus' => \App\Enums\StuntingStatus::class,
            'userRole' => \App\Enums\UserRole::class,
            'wallMaterial' => \App\Enums\WallMaterial::class,
            'waterSource' => \App\Enums\WaterSource::class,

            // --- Sub Dashboard Types (Diurutkan A-Z juga) ---
            'demographicsType' => \App\Enums\DemographicsType::class,
            'economicType' => \App\Enums\EconomicType::class,
            'healthType' => \App\Enums\HealthType::class,
            'infrastructureType' => \App\Enums\InfrastructureType::class,
            'msmeType' => \App\Enums\MsmeType::class,
            'socialType' => \App\Enums\SocialType::class,

            // --- Configurations ---
            'villageSettings' => $settings,
        ]);
        Blade::component('dashboard.manage-data.citizens.components.citizen-profile-card', 'citizen-profile-card');
    }
}
