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
        $citizens = Citizen::all();

        if ($citizens->isEmpty()) {
            return;
        }

        $disabilities = array_column(DisabilityType::cases(), 'value');
        $kbMethods    = array_column(KbMethod::cases(), 'value');
        $bpjsStatuses = array_column(BpjsStatus::cases(), 'value');

        foreach ($citizens as $citizen) {
            $age = $citizen->birth_date?->age ?? rand(10, 60);

            $chance10Percent = rand(1, 100) <= 10;

            $isPregnant = $citizen->gender === Gender::FEMALE->value
                && $age >= 18
                && $age <= 45
                && $chance10Percent;

            HealthProfile::create([
                'citizen_id'      => $citizen->id,
                'disability_type' => $disabilities[array_rand($disabilities)],
                'is_pregnant'     => $isPregnant,
                'kb_method'       => $kbMethods[array_rand($kbMethods)],
                'bpjs_status'     => $bpjsStatuses[array_rand($bpjsStatuses)],
            ]);
        }
    }
}
