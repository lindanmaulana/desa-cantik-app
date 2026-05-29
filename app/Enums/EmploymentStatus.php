<?php

namespace App\Enums;


enum EmploymentStatus: string
{
    case EMPLOYEE = 'employee';
    case EMPLOYER_ASSISTED = 'employer_assisted';
    case EMPLOYER_UNASSISTED = 'employer_unassisted';
    case SELF_EMPLOYED = 'self_employed';
    case CASUAL_WORKER = 'casual_worker';
    case UNPAID_WORKER = 'unpaid_worker';

    public function label(): string
    {
        return match ($this) {
            self::EMPLOYEE => 'Pegawai',
            self::EMPLOYER_ASSISTED => 'Berusaha Dibantu Buruh',
            self::SELF_EMPLOYED => 'Berusaha Sendiri',
            self::CASUAL_WORKER => 'Buruh Harian Lepas',
            self::UNPAID_WORKER => 'Pekerja Keluarga / Tidak Dibayar',
            default => 'Status Tidak Diketahui',
        };
    }
}
