<?php

namespace App\Enums;

enum MeasurementMethod: string
{
    case RECUMBENT = 'recumber';
    case STANDING = 'standing';

    public function label(): string
    {
        return match ($this) {
            self::RECUMBENT => 'Terlentang',
            self::STANDING => 'Berdiri',
            default => 'Tidak diketahui'
        };
    }
}
