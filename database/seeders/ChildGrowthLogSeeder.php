<?php

namespace Database\Seeders;

use App\Enums\MeasurementMethod;
use App\Enums\StuntingStatus;
use App\Models\User;
use App\Models\Citizen;
use App\Models\ChildGrowthLog;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ChildGrowthLogSeeder extends Seeder
{
    public function run(): void
    {
        $operator = User::first() ?? User::factory()->create();

        $toddlers = Citizen::whereDate('birth_date', '>=', Carbon::now()->subYears(5))->get();

        foreach ($toddlers as $child) {
            $ageInMonths = Carbon::parse($child->birth_date)->diffInMonths(now());

            if ($ageInMonths <= 12) {
                $weight = rand(35, 110) / 10;
                $height = rand(50, 78);
                $method = MeasurementMethod::RECUMBENT->value;
            } elseif ($ageInMonths <= 24) {
                $weight = rand(90, 140) / 10;
                $height = rand(75, 90);
                $method = rand(0, 1) ? MeasurementMethod::RECUMBENT->value : MeasurementMethod::STANDING->value;
            } else {
                $weight = rand(120, 220) / 10;
                $height = rand(85, 115);
                $method = MeasurementMethod::STANDING->value;
            }

            $chance = rand(1, 100);
            if ($chance <= 85) {
                $stuntingStatus = StuntingStatus::NORMAL->value;
            } elseif ($chance <= 97) {
                $stuntingStatus = StuntingStatus::STUNTED->value;
            } else {
                $stuntingStatus = StuntingStatus::SEVERELY_STUNTED->value;
            }

            ChildGrowthLog::create([
                'citizen_id' => $child->id,
                'measured_at' => now(),
                'weight' => $weight,
                'height' => $height,
                'measurement_method' => $method,
                'vit_a_received' => $ageInMonths >= 6 ? fake()->boolean(80) : false,
                'stunting_status' => $stuntingStatus,
                'recorded_by' => $operator->id,
                'notes' => fake()->sentence(),
            ]);
        }
    }
}
