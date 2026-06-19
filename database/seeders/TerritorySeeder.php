<?php

namespace Database\Seeders;

use App\Models\Territory;
use Illuminate\Database\Seeder;

class TerritorySeeder extends Seeder
{
    public function run(): void
    {
        $territories = [
            ['sub_village' => 'Dusun Utara', 'area_name' => 'Blok A', 'rw' => '001', 'rt' => '001'],
            ['sub_village' => 'Dusun Utara', 'area_name' => 'Blok B', 'rw' => '001', 'rt' => '002'],
            ['sub_village' => 'Dusun Tengah', 'area_name' => 'Blok C', 'rw' => '002', 'rt' => '001'],
            ['sub_village' => 'Dusun Tengah', 'area_name' => 'Blok D', 'rw' => '002', 'rt' => '002'],
            ['sub_village' => 'Dusun Selatan', 'area_name' => 'Blok E', 'rw' => '003', 'rt' => '001'],
            ['sub_village' => 'Dusun Selatan', 'area_name' => 'Blok F', 'rw' => '003', 'rt' => '002'],
            ['sub_village' => 'Dusun Barat', 'area_name' => 'Blok G', 'rw' => '004', 'rt' => '001'],
            ['sub_village' => 'Dusun Barat', 'area_name' => 'Blok H', 'rw' => '004', 'rt' => '002'],
            ['sub_village' => 'Dusun Timur', 'area_name' => 'Blok I', 'rw' => '005', 'rt' => '001'],
            ['sub_village' => 'Dusun Timur', 'area_name' => 'Blok J', 'rw' => '005', 'rt' => '002'],
        ];

        foreach ($territories as $territory) {
            Territory::create($territory);
        }
    }
}
