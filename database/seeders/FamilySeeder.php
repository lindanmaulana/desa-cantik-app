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

        if ($territories->isEmpty()) {
            return;
        }

        foreach (range(1, 10) as $i) {
            $kkNumber = '3278' . str_pad($i, 12, '0', STR_PAD_LEFT);

            Family::create([
                'territory_id'       => $territories->random()->id,
                'family_card_number' => $kkNumber, 
                'address_detail'     => 'Jl. Pandawa Raya No. ' . $i . ', RT 01/RW 02',
            ]);
        }
    }
}
