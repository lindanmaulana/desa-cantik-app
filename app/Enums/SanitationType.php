<?php

namespace App\Enums;

enum SanitationType: string
{
    case PRIVATE_FLUSH_TOILET = 'private_flush_toilet';
    case SHARED_FLUSH_TOILET = 'shared_flush_toilet';
    case PIT_LATRINE = 'pit_latrine';
    case NO_TOILET = 'no_toilet';

    public function label(): string
    {
        return match ($this) {
            self::PRIVATE_FLUSH_TOILET => 'Jamban Sendiri',
            self::SHARED_FLUSH_TOILET => 'Jamban Bersama',
            self::PIT_LATRINE => 'Cubluk/Pit Latrine',
            self::NO_TOILET => 'Tidak Ada Jamban',
        };
    }
}
