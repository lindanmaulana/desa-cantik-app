<?php

namespace App\Enums;

enum BusinessCategory: string
{
    case CULINARY = 'culinary';
    case FASHION = 'fashion';
    case AGRICULTURE = 'agriculture';
    case SERVICES = 'services';
    case CRAFT = 'craft';
    case TRADE = 'trade';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::CULINARY => 'Kuliner / Makanan',
            self::FASHION => 'Fashion & Pakaian',
            self::AGRICULTURE => 'Pertanian & Peternakan',
            self::SERVICES => 'Jasa / Pelayanan',
            self::CRAFT => 'Kerajinan Tangan',
            self::TRADE => 'Perdangangan / Toko',
            self::OTHER => 'Usaha Lainnya',
        };
    }
}
