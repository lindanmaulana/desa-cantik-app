<?php

namespace App\Enums;

enum WaterSource: string
{
    case PIPED_WATER = 'piped_water';
    case PROTECTED_WELL = 'protected_well';
    case BORE_WELL = 'bore_well';
    case SPRING_WATER = 'spring_water';
    case RIVER_RAINWATER = 'river_rainwater';

    public function label(): string
    {
        return match ($this) {
            self::PIPED_WATER => 'PDAM',
            self::PROTECTED_WELL => 'Sumur Terlindung',
            self::BORE_WELL => 'Sumur Bor',
            self::SPRING_WATER => 'Mata Air',
            self::RIVER_RAINWATER => 'Sungai/Air Hujan',
        };
    }
}
