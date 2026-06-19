<?php

namespace App\Enums;

enum CapitalSource: string
{
    case PERSONAL = 'personal';
    case BANK_LOAN = 'bank_loan';
    case GOVERNMENT_CREDIT = 'goverment_credit';
    case GOVERNMENT_GRANT = 'goverment_grant';
    case FAMILY_RELATIVE = 'family_relative';

    public function label(): string
    {
        return match ($this) {
            self::PERSONAL => 'Modal Sendiri / Pribadi',
            self::BANK_LOAN => 'Pinjaman Bank',
            self::GOVERNMENT_CREDIT => 'Kredit / Program Pemerintah',
            self::GOVERNMENT_GRANT => 'Hibah / Bantuan Pemerintah',
            self::FAMILY_RELATIVE => 'Keluarga / Kerabat',
        };
    }
}
