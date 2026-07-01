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
        $citizens = Citizen::all();

        if ($citizens->isEmpty()) {
            return;
        }

        $educationLevels     = array_column(EducationLevel::cases(), 'value');
        $schoolParticipations = array_column(SchoolParticipation::cases(), 'value');

        foreach ($citizens as $citizen) {
            EducationProfile::create([
                'citizen_id'           => $citizen->id,
                'education_level'      => $educationLevels[array_rand($educationLevels)],
                'highest_diploma'      => 'high_school',
                'school_participation' => $schoolParticipations[array_rand($schoolParticipations)]
            ]);
        }
    }
}
