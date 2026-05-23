<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Citizen;
use App\Models\SocialEconomic;
use Illuminate\Support\Str;

class SocialEconomicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],  
            [
                'id' => Str::uuid()->toString(),
                'citizen_id' => Citizen::first()->id,
                'education_level' => 'elementory_school',
                'occupation' => 'Wiraswasta',
                'monthly_income' => 5000000,
                'is_welfare_recipient' => false,
                'assistance_type' => null,
                'house_condition' => 'proper',
                'economic_status' => 'middle_income',
            ],
        ];

        foreach ($data as $item) {
            SocialEconomic::create($item);
        }
    }
}
