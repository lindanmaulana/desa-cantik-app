<?php

namespace App\Enums;

enum EducationLevel: string {
    case NONE = 'none';
    case ELEMENTORY_SCHOOL = 'elementory_school';
    case MIDDLE_SCHOOL = 'middle_school';
    case HIGH_SCHOOL = 'high_school';
    case ASSOCIATE_DEGREE = 'associate_degree';
    case BACHELOR_DEGREE = 'bachelor_degree';
    case POSTGRADUATE = 'postgraduate';

    public function label(): string {
        return match($this) {
            self::NONE => 'Tidak Sekolah',
            self::ELEMENTORY_SCHOOL => 'SD / Sederajat',
            self::MIDDLE_SCHOOL => 'SMP / Sederajat',
            self::HIGH_SCHOOL => 'SMA / Sederajat',
            self::ASSOCIATE_DEGREE => 'Diploma (D1 - D4)',
            self::BACHELOR_DEGREE => 'Sarjana (S1)',
            self::POSTGRADUATE => 'Pascasarjana (S2 - S3)',
        };
    }
}
