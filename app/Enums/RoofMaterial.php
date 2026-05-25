<?php

namespace App\Enums;

enum RoofMaterial: string
{
    case CONCRETE_TILE = 'concrete_tile';
    case CLAY_TILE = 'clay_tile';
    case METAL_SHEET = 'metal_sheet';
    case ASBESTOS = 'asbestos';
    case THATCH_PALM = 'thatch_palm';

    public function label(): string
    {
        return match ($this) {
            self::CONCRETE_TILE => 'Genteng Beton',
            self::CLAY_TILE => 'Genteng Tanah Liat',
            self::METAL_SHEET => 'Seng/Metal',
            self::ASBESTOS => 'Asbes',
            self::THATCH_PALM => 'Rumbia/Daun',
        };
    }
}
