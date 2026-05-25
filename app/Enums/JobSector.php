<?php

namespace App\Enums;

enum JobSector: string
{
    case AGRICULTURE = 'agriculture';
    case MANUFACTURING = 'manufacturing';
    case TRADE_SERVICE = 'trade_services';
    case GOVERMENT = 'goverment';
    case OTHER = 'other';


    public function label(): string
    {
        return match ($this) {
            self::AGRICULTURE => 'Pertanian',
            self::MANUFACTURING => 'Manufaktur',
            self::TRADE_SERVICE => 'Perdagangan Jasa',
            self::GOVERMENT => 'Pemerintah',
            self::OTHER => 'Lainnya',
        };
    }
}
