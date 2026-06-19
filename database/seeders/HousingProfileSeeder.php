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
        foreach (Family::all() as $family) {
            HousingProfile::create([
                'family_id' => $family->id,
                'house_ownership' => fake()->randomElement(array_column(HouseOwnership::cases(), 'value')),
                'house_condition' => fake()->randomElement(array_column(HouseCondition::cases(), 'value')),
                'floor_material' => fake()->randomElement(array_column(FloorMaterial::cases(), 'value')),
                'wall_material' => fake()->randomElement(array_column(WallMaterial::cases(), 'value')),
                'roof_material' => fake()->randomElement(array_column(RoofMaterial::cases(), 'value')),
                'water_source' => fake()->randomElement(array_column(WaterSource::cases(), 'value')),
                'sanitation_type' => fake()->randomElement(array_column(SanitationType::cases(), 'value')),
                'cooking_fuel' => fake()->randomElement(array_column(CookingFuel::cases(), 'value')),
                'electricity_source' => fake()->randomElement(array_column(ElectricitySource::cases(), 'value')),
                'electricity_capacity' => fake()->randomElement(array_column(ElectricityCapacity::cases(), 'value')),
            ]);
        }
    }
}
