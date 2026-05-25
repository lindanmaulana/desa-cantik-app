<?php

namespace App\Enums;

enum WallMaterial: string
{
    case MASONRY_BRICK = 'masonry_brick';
    case REINFORCED_CONCRETE = 'reinforced_concrete';
    case WOOD_PLANK = 'wood_plank';
    case BAMBOO_WOVEN = 'bamboo_woven';
    case LOGS_THATCH = 'logs_thatch';

    public function label(): string
    {
        return match ($this) {
            self::MASONRY_BRICK => 'Tembok/Bata',
            self::REINFORCED_CONCRETE => 'Beton Bertulang',
            self::WOOD_PLANK => 'Kayu/Papan',
            self::BAMBOO_WOVEN => 'Anyaman Bambu',
            self::LOGS_THATCH => 'Kayu/Gedek',
        };
    }
}
