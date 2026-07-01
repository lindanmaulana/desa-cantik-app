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
        $operator = User::first();

        if (!$operator) {
            $operator = User::create([
                'fullname' => 'Operator Sistem',
                'username' => 'operator_system',
                'password' => bcrypt('password123'),
                'role' => 'operator',
            ]);
        }

        $toddlers = Citizen::whereDate('birth_date', '>=', Carbon::now()->subYears(5))->get();

        if ($toddlers->isEmpty()) {
            return;
        }

        $sampleNotes = [
            'Pertumbuhan anak sangat baik dan sesuai grafik.',
            'Berat badan naik normal, pertahankan pola makan.',
            'Tinggi badan sedikit di bawah rata-rata, perlu pemantauan.',
            'Anak aktif dan sehat saat pemeriksaan.',
            'Diberikan edukasi MPASI kepada orang tua.',
            'Kondisi gizi terpantau baik bulan ini.'
        ];

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

            $receivedVitA = $ageInMonths >= 6 ? (rand(1, 100) <= 80) : false;

            ChildGrowthLog::create([
                'citizen_id'         => $child->id,
                'measured_at'        => now(),
                'weight'             => $weight,
                'height'             => $height,
                'measurement_method' => $method,
                'vit_a_received'     => $receivedVitA,
                'stunting_status'    => $stuntingStatus,
                'recorded_by'        => $operator->id,
                'notes'              => $sampleNotes[array_rand($sampleNotes)],
            ]);
        }
    }
}
