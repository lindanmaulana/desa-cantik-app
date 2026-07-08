<?php

namespace App\Enums;

enum BloodType: string
{
    case A_POS = 'A+';
    case A_NEG = 'A-';
    case B_POS = 'B+';
    case B_NEG = 'B-';
    case AB_POS = 'AB+';
    case AB_NEG = 'AB-';
    case O_POS = 'O+';
    case O_NEG = 'O-';
    case NOT_KNOWN = '-';

    public function label(): string
    {
        return match($this) {
            self::A_POS => 'A Rh+',
            self::A_NEG => 'A Rh-',
            self::B_POS => 'B Rh+',
            self::B_NEG => 'B Rh-',
            self::AB_POS => 'AB Rh+',
            self::AB_NEG => 'AB Rh-',
            self::O_POS => 'O Rh+',
            self::O_NEG => 'O Rh-',
            self::NOT_KNOWN => 'Tidak Tahu / Belum Cek',
        };
    }
}
