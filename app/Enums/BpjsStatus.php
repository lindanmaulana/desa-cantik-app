<?php

namespace App\Enums;

enum BpjsStatus: string
{
    case NONE = 'NONE';
    case GOVERMENT_SUBSIDIZED = 'goverment_subsidized';
    case INDEPENDENT_MEMBER = 'independent_member';
    case COMPANY_MEMBER = 'company_member';

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'Tidak Ada',
            self::GOVERMENT_SUBSIDIZED => 'Disubsidi Pemerintah',
            self::INDEPENDENT_MEMBER => 'Anggota Independen',
            self::COMPANY_MEMBER => 'Anggota Perusahaan'
        };
    }
}
