<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Citizen;
use App\Models\Family;

class CitizensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_number' => '3273052301000001',
                'family_id' => Family::first()->id,
                'full_name' => 'H. JOKO SUSILO',
                'family_role' => 'head_of_family',
                'gender' => 'male',
                'birth_place' => 'CIREBON',
                'birth_date' => '1960-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'A',
            ],
            [
                'id_number' => '3273052301000002',
                'family_id' => Family::first()->id,
                'full_name' => 'SITI NURHALIZA',
                'family_role' => 'parent',
                'gender' => 'female',
                'birth_place' => 'CIREBON',
                'birth_date' => '1962-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'B',
            ],
            [
                'id_number' => '3273052301000003',
                'family_id' => Family::first()->id,
                'full_name' => 'ANDI PRATAMA',
                'family_role' => 'head_of_family',
                'gender' => 'male',
                'birth_place' => 'BANDUNG',
                'birth_date' => '1985-05-15',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'O',
            ],
            [
                'id_number' => '3273052301000004',
                'family_id' => Family::first()->id,
                'full_name' => 'SITI NURHALIZA',
                'family_role' => 'parent',
                'gender' => 'female',
                'birth_place' => 'BANDUNG',
                'birth_date' => '1987-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'B',
            ],
            [
                'id_number' => '3273052301000005',
                'family_id' =>  Family::first()->id,
                'full_name' => 'Budi Santoso',
                'family_role' => 'head_of_family',
                'gender' => 'male',
                'birth_place' => 'CIREBON',
                'birth_date' => '1990-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'A',
            ],
            [
                'id_number' => '3273052301000006',
                'family_id' =>  Family::first()->id,
                'full_name' => 'SITI NURHALIZA',
                'family_role' => 'parent',
                'gender' => 'female',
                'birth_place' => 'CIREBON',
                'birth_date' => '1992-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'B',
            ],
            [
                'id_number' => '3273052301000007',
                'family_id' => Family::first()->id,
                'full_name' => 'Budi Santoso',
                'family_role' => 'head_of_family',
                'gender' => 'male',
                'birth_place' => 'CIREBON',
                'birth_date' => '1990-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'A',
            ],
            [
                'id_number' => '3273052301000008',
                'family_id' => Family::first()->id,
                'full_name' => 'SITI NURHALIZA',
                'family_role' => 'parent',
                'gender' => 'female',
                'birth_place' => 'CIREBON',
                'birth_date' => '1992-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'B',
            ],
            [
                'id_number' => '3273052301000009',
                'family_id' => Family::first()->id,
                'full_name' => 'Budi Santoso',
                'family_role' => 'head_of_family',
                'gender' => 'male',
                'birth_place' => 'CIREBON',
                'birth_date' => '1990-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'A',
            ],
            [
                'id_number' => '3273052301000010',
                'family_id' => Family::first()->id,
                'full_name' => 'SITI NURHALIZA',
                'family_role' => 'parent',
                'gender' => 'female',
                'birth_place' => 'CIREBON',
                'birth_date' => '1992-01-01',
                'religion' => 'islam',
                'marital_status' => 'married',
                'blood_type' => 'B',
            ],
        ];

        foreach ($data as $item) {
            Citizen::create($item);
        }
    }
}
