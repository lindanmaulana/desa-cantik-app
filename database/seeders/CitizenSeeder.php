<?php

namespace Database\Seeders;

use App\Models\Citizen;
use App\Models\Family;
use Illuminate\Database\Seeder;

class CitizenSeeder extends Seeder
{
    public function run(): void
    {
        $families = Family::all();

        foreach ($families as $family) {

            Citizen::create([
                'family_id' => $family->id,
                'id_number' => fake()->unique()->numerify('3278############'),
                'full_name' => fake()->name('male'),
                'family_role' => 'head_of_family',
                'gender' => 'male',
                'birth_place' => 'Majalengka',
                'birth_date' => now()->subYears(rand(30, 60)),
                'religion' => 'islam',
                'marital_status' => 'married',
            ]);

            Citizen::create([
                'family_id' => $family->id,
                'id_number' => fake()->unique()->numerify('3278############'),
                'full_name' => fake()->name('female'),
                'family_role' => 'spouse',
                'gender' => 'female',
                'birth_place' => 'Majalengka',
                'birth_date' => now()->subYears(rand(25, 55)),
                'religion' => 'islam',
                'marital_status' => 'married',
            ]);

            Citizen::create([
                'family_id' => $family->id,
                'id_number' => fake()->unique()->numerify('3278############'),
                'full_name' => fake()->name(),
                'family_role' => 'child',
                'gender' => fake()->randomElement(['male', 'female']),
                'birth_place' => 'Majalengka',
                'birth_date' => now()->subYears(rand(1, 18)),
                'religion' => 'islam',
                'marital_status' => 'single',
            ]);
        }
    }
}
