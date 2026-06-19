<?php

namespace Database\Seeders;

use App\Enums\EconomicStatus;
use App\Enums\EmploymentStatus;
use App\Enums\JobSector;
use App\Models\Citizen;
use App\Models\EmploymentProfile;
use Illuminate\Database\Seeder;

class EmploymentProfileSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Citizen::all() as $citizen) {
            EmploymentProfile::create([
                'citizen_id' => $citizen->id,
                'occupation' => fake()->jobTitle(),
                'job_sector' => fake()->randomElement(array_column(JobSector::cases(), 'value')),
                'employment_status' => fake()->randomElement(array_column(EmploymentStatus::cases(), 'value')),
                'monthly_income' => rand(1000000, 10000000),
                'economic_status' => fake()->randomElement(array_column(EconomicStatus::cases(), 'value')),
                'is_welfare_recipient' => fake()->boolean(),
            ]);
        }
    }
}
