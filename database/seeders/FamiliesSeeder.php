<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Family;
use App\Models\Territory;

class FamiliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data = [
        //     [
        //         'id' => Str::uuid()->toString(),
        //         'territory_id' => Territory::first()->id,
        //         'family_card_number' => '1234567890123456',
        //         'address_detail' => 'Jl. Contoh No. 1',
        //     ],
        //     [
        //         'id' => Str::uuid()->toString(),
        //         'territory_id' => Territory::first()->id,
        //         'family_card_number' => '1234567890123456',
        //         'address_detail' => 'Jl. Contoh No. 1',
        //     ],
        //     [
        //         'id' => Str::uuid()->toString(),
        //         'territory_id' => Territory::first()->id,
        //         'family_card_number' => '1234567890123456',
        //         'address_detail' => 'Jl. Contoh No. 1',
        //     ],
        //     [
        //         'id' => Str::uuid()->toString(),
        //         'territory_id' => Territory::first()->id,
        //         'family_card_number' => '1234567890123456',
        //         'address_detail' => 'Jl. Contoh No. 1',
        //     ],
        // ];

        // foreach ($data as $item) {
        //     Family::create($item);
        // }
    }
}
