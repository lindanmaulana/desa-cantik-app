<?php

namespace App\Enums;

enum UmkmType: string
{
    case BUSINESS_SECTOR = 'business_category';
    case OWNER_AGE = 'owner_age';
    case OWNER_EDUCATION = 'owner_education';
    case BUSINESS_LOCATION = 'business_location';
    case LEGAL_STATUS = 'legal_entity_type';
    case NIB_OWNERSHIP = 'license_number';
    case MONTHLY_TURNOVER = 'monthly_revenue';
    case DIGITAL_TRANSACTION = 'uses_digital_payment';
    case DIGITAL_PLATFORM = 'digita_platform_type'; // Menyesuaikan typo skema 'digita_platform_type'
    case CAPITAL_SOURCE = 'capital_source';
    case ECO_FRIENDLY = 'is_environmentally_friendly';
    case BUMDES_PARTNERSHIP = 'bumdes_partnership_status';

    public function title(): string
    {
        return match($this) {
            self::BUSINESS_SECTOR => 'Sektor Usaha UMKM',
            self::OWNER_AGE => 'Usia Pemilik Usaha',
            self::OWNER_EDUCATION => 'Pendidikan Pemilik Usaha',
            self::BUSINESS_LOCATION => 'Lokasi Tempat Usaha',
            self::LEGAL_STATUS => 'Badan Hukum Usaha',
            self::NIB_OWNERSHIP => 'Kepemilikan NIB / Izin Usaha',
            self::MONTHLY_TURNOVER => 'Omzet / Pendapatan Bulanan',
            self::DIGITAL_TRANSACTION => 'Pemanfaatan Transaksi Digital',
            self::DIGITAL_PLATFORM => 'Penggunaan Platform Digital',
            self::CAPITAL_SOURCE => 'Sumber Modal Usaha',
            self::ECO_FRIENDLY => 'Standar Ramah Lingkungan',
            self::BUMDES_PARTNERSHIP => 'Kemitraan BUM Desa',
        };
    }

    public function chartType(): string
    {
        return match($this) {
            self::BUSINESS_SECTOR, self::OWNER_AGE, self::OWNER_EDUCATION, self::MONTHLY_TURNOVER, self::CAPITAL_SOURCE => 'bar',
            self::BUSINESS_LOCATION, self::LEGAL_STATUS, self::NIB_OWNERSHIP, self::DIGITAL_TRANSACTION, self::DIGITAL_PLATFORM, self::ECO_FRIENDLY, self::BUMDES_PARTNERSHIP => 'donut',
        };
    }
}
