<?php

namespace App\Providers;

use App\Services\Settings\VillageSettingService;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(VillageSettingService $villageSettingService): void
    {
        // if (config('app.env') === 'production' || env('FORCE_HTTPS', false)) {
        //     URL::forceScheme('https');
        // }

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
            'userRole' => \App\Enums\UserRole::class,
            'gender' => \App\Enums\Gender::class,
            'familyRole' => \App\Enums\FamilyRole::class,
            'religion' => \App\Enums\Religion::class,
            'maritalStatus' => \App\Enums\MaritalStatus::class,
            'educationLevel' => \App\Enums\EducationLevel::class,
            'schoolParticipation' => \App\Enums\SchoolParticipation::class,
            'jobSector' => \App\Enums\JobSector::class,
            'employmentStatus' => \App\Enums\EmploymentStatus::class,
            'economicStatus' => \App\Enums\EconomicStatus::class,
            'disabilityType' => \App\Enums\DisabilityType::class,
            'bpjsStatus' => \App\Enums\BpjsStatus::class,
            'businessCategory' => \App\Enums\BusinessCategory::class,
            'facilityType' => \App\Enums\FacilityType::class,
            'conditionInfrastructure' => \App\Enums\ConditionInfrastructure::class,
            'kbMethod' => \App\Enums\KbMethod::class,
            'houseOwnership' => \App\Enums\HouseOwnership::class,
            'houseCondition' => \App\Enums\HouseCondition::class,
            'floorMaterial' => \App\Enums\FloorMaterial::class,
            'wallMaterial' => \App\Enums\WallMaterial::class,
            'roofMaterial' => \App\Enums\RoofMaterial::class,
            'waterSource' => \App\Enums\WaterSource::class,
            'sanitationType' => \App\Enums\SanitationType::class,
            'cookingFuel' => \App\Enums\CookingFuel::class,
            'electricitySource' => \App\Enums\ElectricitySource::class,
            'electricityCapacity' => \App\Enums\ElectricityCapacity::class,
            'stuntingStatus' => \App\Enums\StuntingStatus::class,

            'legalEntityType' => \App\Enums\LegalEntityType::class,
            'digitalPlatformType' => \App\Enums\DigitalPlatformType::class,
            'bumdesPartnershipStatus' => \App\Enums\BumdesPartnershipStatus::class,

            'demographicsType' => \App\Enums\DemographicsType::class,
            'socialType' => \App\Enums\SocialType::class,
            'healthType' => \App\Enums\HealthType::class,
            'economicType' => \App\Enums\EconomicType::class,
            'msmeType' => \App\Enums\MsmeType::class,
            'infrastructureType' => \App\Enums\InfrastructureType::class,

            'villageSettings' => $settings,
        ]);

        Blade::component('dashboard.manage-data.citizens.components.citizen-profile-card', 'citizen-profile-card');
    }
}
