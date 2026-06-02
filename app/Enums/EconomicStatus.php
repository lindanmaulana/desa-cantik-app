<?php

namespace App\Enums;

enum EconomicStatus: string
{
    case VERY_POOR = 'very_poor';
    case POOR = 'poor';
    case NEAR_POOR = 'near_poor';
    case MIDDLE_INCOME = 'middle_income';
    case HIGH_INCOME = 'high_income';

    public function label(): string
    {
        return match ($this) {
            self::VERY_POOR => 'Sangat Miskin',
            self::POOR => 'Miskin',
            self::NEAR_POOR => 'Hampir Miskin',
            self::MIDDLE_INCOME => 'Menengah',
            self::HIGH_INCOME => 'Mampu / Kaya',
        };
    }

    public function style(): string
    {
        return match ($this) {
            self::VERY_POOR => 'bg-red-100 text-red-800 border-red-200',
            self::POOR => 'bg-orange-100 text-orange-800 border-orange-200',
            self::NEAR_POOR => 'bg-yellow-100 text-yellow-800 border-yellow-200',
            self::MIDDLE_INCOME => 'bg-blue-100 text-blue-800 border-blue-200',
            self::HIGH_INCOME => 'bg-green-100 text-green-800 border-green-200',
        };
    }
}
