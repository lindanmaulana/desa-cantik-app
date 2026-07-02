<?php

namespace App\Enums;

enum ConditionInfrastructure: string {
    case GOOD = 'good';
    case DAMAGED_LIGHT = 'damaged_light';
    case DAMAGED_SEVERE = 'damaged_severe';

    public function label(): string {
        return match($this) {
            self::GOOD => 'Baik / Layak',
            self::DAMAGED_LIGHT => 'Rusak Ringan',
            self::DAMAGED_SEVERE => 'Rusak Berat',
        };
    }
}
