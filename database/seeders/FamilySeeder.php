<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\Territory;
use Illuminate\Database\Seeder;

class FamilySeeder extends Seeder
{
    public function run(): void
    {
        $territories = Territory::all();

        foreach (range(1,10) as $i) {
            Family::create([
                'territory_id' => $territories->random()->id,
                'family_card_number' => fake()->unique()->numerify('3278############'),
                'address_detail' => fake()->address(),
            ]);
        }
    }
}
