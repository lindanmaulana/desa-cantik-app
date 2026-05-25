<?php

namespace App\Enums;

enum KbMethod: string
{
    case NONE = 'none';
    case INJECTION = 'injection';
    case PILL = 'pill';
    case CONDOM = 'condom';
    case IMPLANT = 'implant';
    case IUD = 'iud';
    case TUBAL_LIGATION = 'tubal_ligation';
    case VESECTOMY = 'vesectomy';

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'Tidak Ada',
            self::INJECTION => 'Suntikan',
            self::PILL => 'Pill',
            self::CONDOM => 'Kondom',
            self::IMPLANT => 'Implan',
            self::IUD => 'IUD',
            self::TUBAL_LIGATION => 'Ligasi Tuba',
            self::VESECTOMY => 'Vesektomi'
        };
    }
}
