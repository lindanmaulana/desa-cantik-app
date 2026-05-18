<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Territory;

class TerritoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 1', 'rw' => 1, 'rt' => 1],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 2', 'rw' => 1, 'rt' => 2],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 3', 'rw' => 1, 'rt' => 3],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 4', 'rw' => 1, 'rt' => 4],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 5', 'rw' => 1, 'rt' => 5],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 6', 'rw' => 1, 'rt' => 6],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 7', 'rw' => 1, 'rt' => 7],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 8', 'rw' => 1, 'rt' => 8],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 9', 'rw' => 1, 'rt' => 9],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 10', 'rw' => 1, 'rt' => 10],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 11', 'rw' => 1, 'rt' => 11],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 12', 'rw' => 1, 'rt' => 12],
            ['sub_village' => 'pahing', 'area_name' => 'rt 1 rw 13', 'rw' => 1, 'rt' => 13],

            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 1', 'rw' => 1, 'rt' => 1],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 2', 'rw' => 1, 'rt' => 2],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 3', 'rw' => 1, 'rt' => 3],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 4', 'rw' => 1, 'rt' => 4],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 5', 'rw' => 1, 'rt' => 5],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 6', 'rw' => 1, 'rt' => 6],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 7', 'rw' => 1, 'rt' => 7],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 8', 'rw' => 1, 'rt' => 8],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 9', 'rw' => 1, 'rt' => 9],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 10', 'rw' => 1, 'rt' => 10],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 11', 'rw' => 1, 'rt' => 11],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 12', 'rw' => 1, 'rt' => 12],
            ['sub_village' => 'pon', 'area_name' => 'rt 1 rw 13', 'rw' => 1, 'rt' => 13],

            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 1', 'rw' => 1, 'rt' => 1],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 2', 'rw' => 1, 'rt' => 2],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 3', 'rw' => 1, 'rt' => 3],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 4', 'rw' => 1, 'rt' => 4],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 5', 'rw' => 1, 'rt' => 5],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 6', 'rw' => 1, 'rt' => 6],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 7', 'rw' => 1, 'rt' => 7],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 8', 'rw' => 1, 'rt' => 8],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 9', 'rw' => 1, 'rt' => 9],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 10', 'rw' => 1, 'rt' => 10],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 11', 'rw' => 1, 'rt' => 11],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 12', 'rw' => 1, 'rt' => 12],
            ['sub_village' => 'wage', 'area_name' => 'rt 1 rw 13', 'rw' => 1, 'rt' => 13],
        ];

        foreach ($data as $item) {
            Territory::create($item);
        }
    }
}
