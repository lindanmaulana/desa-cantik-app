<?php

namespace App\Enums;

enum LegalEntityType: string {
    case UNREGISTERED = 'unregistered';
    case SOLE_PROPRIETORSHIP = 'sole_proprietorship';
    case LIMITED_PARTNERSHIP = 'limited_partnership';
    case LIMITED_COMPANY = 'limited_company';
    case COOPERATIVE = 'cooperative';

    public function label(): string {
        return match($this) {
            self::UNREGISTERED => 'Belum Terdaftar / Non-Badan Hukum',
            self::SOLE_PROPRIETORSHIP => 'Perusahaan Perseorangan (PP)',
            self::LIMITED_PARTNERSHIP => 'Persekutuan Komanditer (CV',
            self::LIMITED_COMPANY => 'Perseroan Terbatas (PT)',
            self::COOPERATIVE => 'Koperasi'
        };
    }
}

