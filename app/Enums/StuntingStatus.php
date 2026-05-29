<?php

namespace App\Enums;

enum StuntingStatus: string {
    case NORMAL = 'normal';
    case STUNTED = 'stunted';
    case SEVERELY_STUNTED = 'severely_stunted';

    public function label(): string {
        return match($this) {
            self::NORMAL => 'Normal',
            self::STUNTED => 'Pendek / Stunting',
            self::SEVERELY_STUNTED => 'Sangat Pendek / Stunting'
        };
    }
}
