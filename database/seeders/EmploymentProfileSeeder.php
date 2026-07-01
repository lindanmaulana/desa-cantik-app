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
        $citizens = Citizen::all();

        if ($citizens->isEmpty()) {
            return;
        }

        $jobSectors        = array_column(JobSector::cases(), 'value');
        $employmentStatuses = array_column(EmploymentStatus::cases(), 'value');
        $economicStatuses   = array_column(EconomicStatus::cases(), 'value');

        $occupations = [
            'Petani', 'Buruh Harian Lepas', 'Karyawan Swasta', 'Wiraswasta',
            'PNS', 'Guru', 'Pedagang', 'Ibu Rumah Tangga', 'Belum/Tidak Bekerja'
        ];

        foreach ($citizens as $citizen) {
            EmploymentProfile::create([
                'citizen_id'           => $citizen->id,
                'occupation'           => $occupations[array_rand($occupations)],
                'job_sector'           => $jobSectors[array_rand($jobSectors)],
                'employment_status'    => $employmentStatuses[array_rand($employmentStatuses)],
                'monthly_income'       => rand(1000000, 10000000),
                'economic_status'      => $economicStatuses[array_rand($economicStatuses)],
                'is_welfare_recipient' => (bool) rand(0, 1),
            ]);
        }
    }
}
