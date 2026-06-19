<?php

namespace Database\Seeders;

use App\Enums\BpjsStatus;
use App\Enums\DisabilityType;
use App\Enums\Gender;
use App\Enums\KbMethod;
use App\Models\Citizen;
use App\Models\HealthProfile;
use Illuminate\Database\Seeder;

class HealthProfileSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Citizen::all() as $citizen) {

            $age = $citizen->birth_date?->age;

            $isPregnant =
                $citizen->gender === Gender::FEMALE->value
                && $age >= 18
                && $age <= 45
                && fake()->boolean(10);

            HealthProfile::create([
                'citizen_id' => $citizen->id,
                'disability_type' => fake()->randomElement(array_column(DisabilityType::cases(), 'value')),
                'is_pregnant' => $isPregnant,
                'kb_method' => fake()->randomElement(array_column(KbMethod::cases(), 'value')),
                'bpjs_status' => fake()->randomElement(array_column(BpjsStatus::cases(), 'value')),
            ]);
        }
    }
}
