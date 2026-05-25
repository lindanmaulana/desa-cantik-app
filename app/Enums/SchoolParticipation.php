<?php

namespace App\Enums;

enum SchoolParticipation: string {
    case NOT_YET_IN_SCHOOL = 'not_yet_in_school';
    case CURRENTLY_IN_SCHOOL = 'currently_in_school';
    case NOT_ATTENDING_ANYMORE = 'not_attending_anymore';

    public function label(): string {
        return match($this) {
            self::NOT_YET_IN_SCHOOL => 'Belum Bersekolah',
            self::CURRENTLY_IN_SCHOOL => 'Sedang Bersekolah',
            self::NOT_ATTENDING_ANYMORE => 'TIdak Bersekolah Lagi'
        };
    }
}
