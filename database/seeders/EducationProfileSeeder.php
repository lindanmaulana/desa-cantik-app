<?php

namespace Database\Seeders;

use App\Enums\EducationLevel;
use App\Enums\SchoolParticipation;
use App\Models\Citizen;
use App\Models\EducationProfile;
use Illuminate\Database\Seeder;

class EducationProfileSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Citizen::all() as $citizen) {

            EducationProfile::create([
                'citizen_id' => $citizen->id,
                'education_level' => fake()->randomElement(array_column(EducationLevel::cases(), 'value')),
                'highest_diploma' => 'high_school',
                'school_participation' => fake()->randomElement(array_column(SchoolParticipation::cases(), 'value'))
            ]);
        }
    }
}


