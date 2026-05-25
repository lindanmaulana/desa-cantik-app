<?php

namespace App\Enums;

enum CookingFuel: string
{
    case ELECTRICITY = 'electricity';
    case LPG_GAS = 'lpg_gas';
    case KEROSENE = 'kerosene';
    case BIOGAS = 'biogas';
    case WOOD_CHARCOAL = 'wood_charcoal';

    public function label(): string
    {
        return match ($this) {
            self::ELECTRICITY => 'Listrik',
            self::LPG_GAS => 'Gas LPG',
            self::KEROSENE => 'Minyak Tanah',
            self::BIOGAS => 'Biogas',
            self::WOOD_CHARCOAL => 'Kayu/Arang',
        };
    }
}
