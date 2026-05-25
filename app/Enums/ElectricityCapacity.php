<?php

namespace App\Enums;

enum ElectricityCapacity: string
{
    case NON_ELECTRIC = 'non_electric';
    case VA_450 = '450va';
    case VA_900 = '900va';
    case VA_1300 = '1300va';
    case VA_2200 = '2200va';
    case ABOVE_2200VA = 'above_2200va';

    public function label(): string
    {
        return match ($this) {
            self::NON_ELECTRIC => 'Tidak Ada Listrik',
            self::VA_450 => '450 VA',
            self::VA_900 => '900 VA',
            self::VA_1300 => '1300 VA',
            self::VA_2200 => '2200 VA',
            self::ABOVE_2200VA => '> 2200 VA',
        };
    }
}
