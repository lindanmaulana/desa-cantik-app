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
        $facilityTypes = array_column(FacilityType::cases(), 'value');
        $conditions = array_column(ConditionInfrastructure::cases(), 'value');

        $fundingSources = ['APBD Kabupaten', 'APBN', 'Dana Desa', 'Swadaya Masyarakat', 'Corporate Social Responsibility (CSR)'];

        foreach (range(1, 10) as $i) {
            Infrastructure::create([
                'facility_name'     => "Fasilitas $i",
                'facility_type'     => $facilityTypes[array_rand($facilityTypes)],
                'condition'         => $conditions[array_rand($conditions)],
                'construction_year' => rand(2000, 2025), // Ini aman karena fungsi native PHP
                'funding_source'    => $fundingSources[array_rand($fundingSources)],
            ]);
        }
    }
}
