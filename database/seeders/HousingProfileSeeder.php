<?php

namespace Database\Seeders;

use App\Enums\CookingFuel;
use App\Enums\ElectricityCapacity;
use App\Enums\ElectricitySource;
use App\Enums\FloorMaterial;
use App\Enums\HouseCondition;
use App\Enums\HouseOwnership;
use App\Enums\RoofMaterial;
use App\Enums\SanitationType;
use App\Enums\WallMaterial;
use App\Enums\WaterSource;
use App\Models\Family;
use App\Models\HousingProfile;
use Illuminate\Database\Seeder;

class HousingProfileSeeder extends Seeder
{
    public function run(): void
    {
        $families = Family::all();

        if ($families->isEmpty()) {
            return;
        }

        $houseOwnerships = array_column(HouseOwnership::cases(), 'value');
        $houseConditions = array_column(HouseCondition::cases(), 'value');
        $floorMaterials  = array_column(FloorMaterial::cases(), 'value');
        $wallMaterials   = array_column(WallMaterial::cases(), 'value');
        $roofMaterials   = array_column(RoofMaterial::cases(), 'value');
        $waterSources    = array_column(WaterSource::cases(), 'value');
        $sanitationTypes = array_column(SanitationType::cases(), 'value');
        $cookingFuels    = array_column(CookingFuel::cases(), 'value');
        $electricitySrcs = array_column(ElectricitySource::cases(), 'value');
        $electricityCaps = array_column(ElectricityCapacity::cases(), 'value');

        foreach ($families as $family) {
            HousingProfile::create([
                'family_id'            => $family->id,
                'house_ownership'      => $houseOwnerships[array_rand($houseOwnerships)],
                'house_condition'      => $houseConditions[array_rand($houseConditions)],
                'floor_material'       => $floorMaterials[array_rand($floorMaterials)],
                'wall_material'        => $wallMaterials[array_rand($wallMaterials)],
                'roof_material'        => $roofMaterials[array_rand($roofMaterials)],
                'water_source'         => $waterSources[array_rand($waterSources)],
                'sanitation_type'      => $sanitationTypes[array_rand($sanitationTypes)],
                'cooking_fuel'         => $cookingFuels[array_rand($cookingFuels)],
                'electricity_source'   => $electricitySrcs[array_rand($electricitySrcs)],
                'electricity_capacity' => $electricityCaps[array_rand($electricityCaps)],
            ]);
        }
    }
}
