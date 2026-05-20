<?php

namespace App\Enums;

enum Religion: string
{
    case ISLAM = 'islam';
    case PROTESTANT = 'protestant';
    case CATHOLIC = 'catholic';
    case HINDU = 'hindu';
    case BUDHA = 'budha';
    case CONFUCIAN = 'confucian';
    case OTHER = 'other';


    public function label(): string
    {
        return match ($this) {
            self::ISLAM => 'Islam',
            self::PROTESTANT => 'Kristen Protestan',
            self::CATHOLIC => 'Katolik',
            self::HINDU => 'Hindu',
            self::BUDHA => 'Buddha',
            self::CONFUCIAN => 'Konghucu',
            self::OTHER => 'Lainnya',
        };
    }
}
