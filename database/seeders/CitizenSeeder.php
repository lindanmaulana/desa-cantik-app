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

        if ($families->isEmpty()) {
            return;
        }

        $maleNames = ['Budi Santoso', 'Ahmad Hidayat', 'Dedi Setiadi', 'Suryana', 'Cecep Supriatna', 'Agus Prayitno', 'Iwan Setiawan', 'Maman Abdurahman'];
        $femaleNames = ['Siti Aminah', 'Dewi Lestari', 'Sri Wahyuni', 'Neng Fitri', 'Euis Marlina', 'Rina Herawati', 'Diana Putri', 'Ani Suryani'];
        $childNames = ['Rizky', 'Aditya', 'Putri', 'Angga', 'Salsa', 'Dimas', 'Tiara', 'Zaki', 'Nabila', 'Farel'];

        $genders = ['male', 'female'];

        foreach ($families as $index => $family) {
            $bapakName = $maleNames[($index) % count($maleNames)] . ' ' . ($index + 1);
            $ibuName = $femaleNames[($index) % count($femaleNames)] . ' ' . ($index + 1);
            $anakName = $childNames[($index) % count($childNames)] . ' ' . ($index + 1);

            Citizen::create([
                'family_id'      => $family->id,
                'id_number'      => '3278' . rand(100000000000, 999999999999),
                'full_name'      => $bapakName,
                'family_role'    => 'head_of_family',
                'gender'         => 'male',
                'birth_place'    => 'Majalengka',
                'birth_date'     => now()->subYears(rand(30, 60)),
                'religion'       => 'islam',
                'marital_status' => 'married',
            ]);

            Citizen::create([
                'family_id'      => $family->id,
                'id_number'      => '3278' . rand(100000000000, 999999999999),
                'full_name'      => $ibuName,
                'family_role'    => 'spouse',
                'gender'         => 'female',
                'birth_place'    => 'Majalengka',
                'birth_date'     => now()->subYears(rand(25, 55)),
                'religion'       => 'islam',
                'marital_status' => 'married',
            ]);

            $randomGender = $genders[array_rand($genders)];
            Citizen::create([
                'family_id'      => $family->id,
                'id_number'      => '3278' . rand(100000000000, 999999999999),
                'full_name'      => $anakName,
                'family_role'    => 'child',
                'gender'         => $randomGender,
                'birth_place'    => 'Majalengka',
                'birth_date'     => now()->subYears(rand(1, 18)),
                'religion'       => 'islam',
                'marital_status' => 'single',
            ]);
        }
    }
}
