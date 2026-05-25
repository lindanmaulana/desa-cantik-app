<?php

namespace App\Enums;

enum DisabilityType: string
{
    case NONE = 'none';
    case PHYSICAL = 'physical';
    case INTELLECTUAL = 'intellectual';
    case MENTAL = 'mental';
    case SENSORY = 'sensory';

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'Tidak Ada',
            self::PHYSICAL => 'Fisik',
            self::INTELLECTUAL => 'Intelektual',
            self::MENTAL => 'Mental',
            self::SENSORY => 'Sensorik',
        };
    }
}
