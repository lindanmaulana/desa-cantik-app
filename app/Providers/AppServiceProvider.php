<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        Relation::morphMap([
            'resident_house' => \App\Models\Citizen::class,
            'public_facility' => \App\Models\Infrastructure::class,
            'msme_location' => \App\Models\Msme::class,
        ]);

        View::share([
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
            'demographicsType' => \App\Enums\DemographicsType::class,
        ]);

        Blade::component('dashboard.manage-data.citizens.components.citizen-profile-card', 'citizen-profile-card');
    }
}
