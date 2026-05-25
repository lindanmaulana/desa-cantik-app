<?php

namespace App\Enums;

enum FloorMaterial: string
{
    case MARBLE_GRANITE = 'marble_granite';
    case CERAMIC_TILE = 'ceramic_tile';
    case CEMENT_BRICK = 'cement_brick';
    case WOOD_TIMBER = 'wood_timber';
    case BAMBOO = 'bamboo';
    case DIRT_EARTH = 'dirt_earth';

    public function label(): string
    {
        return match ($this) {
            self::MARBLE_GRANITE => 'Marmer/Granit',
            self::CERAMIC_TILE => 'Keramik',
            self::CEMENT_BRICK => 'Semen/Bata',
            self::WOOD_TIMBER => 'Kayu/Papan',
            self::BAMBOO => 'Bambu',
            self::DIRT_EARTH => 'Tanah',
        };
    }
}
