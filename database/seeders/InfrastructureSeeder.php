<?php

namespace Database\Seeders;

use App\Enums\ConditionInfrastructure;
use App\Enums\FacilityType;
use App\Models\Infrastructure;
use Illuminate\Database\Seeder;

class InfrastructureSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 10) as $i) {
            Infrastructure::create([
                'facility_name' => "Fasilitas $i",
                'facility_type' => fake()->randomElement(array_column(FacilityType::cases(), 'value')),
                'condition' => fake()->randomElement(array_column(ConditionInfrastructure::cases(), 'value')),
                'construction_year' => rand(2000, 2025),
                'funding_source' => fake()->company(),
            ]);
        }
    }
}
