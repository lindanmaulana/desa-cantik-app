<?php

namespace App\Enums;

enum MsmeType: string
{
    case BUSINESS_SECTOR = 'business_category';
    case OWNER_AGE = 'owner_age';
    case OWNER_EDUCATION = 'owner_education';
    case BUSINESS_LOCATION = 'business_location';
    case LEGAL_STATUS = 'legal_entity_type';
    case NIB_OWNERSHIP = 'license_number';
    case MONTHLY_TURNOVER = 'monthly_revenue';
    case DIGITAL_TRANSACTION = 'uses_digital_payment';
    case DIGITAL_PLATFORM = 'digita_platform_type';
    case CAPITAL_SOURCE = 'capital_source';
    case ECO_FRIENDLY = 'is_environmentally_friendly';
    case BUMDES_PARTNERSHIP = 'bumdes_partnership_status';

    public function title(): string
    {
        return match ($this) {
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
        return match ($this) {
            self::BUSINESS_SECTOR, self::OWNER_AGE, self::OWNER_EDUCATION, self::MONTHLY_TURNOVER, self::CAPITAL_SOURCE => 'bar',
            self::BUSINESS_LOCATION, self::LEGAL_STATUS, self::NIB_OWNERSHIP, self::DIGITAL_TRANSACTION, self::DIGITAL_PLATFORM, self::ECO_FRIENDLY, self::BUMDES_PARTNERSHIP => 'donut',
        };
    }

    public function labels(): array
    {
        return match ($this) {
            self::BUSINESS_SECTOR => [
                'Culinary',
                'Fashion',
                'Agriculture',
                'Services',
                'Craft',
                'Trade',
                'Other'
            ],
            self::OWNER_AGE => [
                'Gen Z & Milenial Muda (<30 Thn)',
                'Produktif Matang (30-50 Thn)',
                'Senior / Lansia (>50 Thn)'
            ],
            self::OWNER_EDUCATION => [
                'Tidak Sekolah',
                'SD / Sederajat',
                'SMP / Sederajat',
                'SMA / Sederajat',
                'Diploma (D1-D4)',
                'Sarjana (S1)',
                'Pascasarjana (S2/S3)'
            ],
            self::BUSINESS_LOCATION => [
                'Domisili Rumah Tinggal',
                'Kios / Tempat Usaha Khusus'
            ],
            self::LEGAL_STATUS => [
                'Unregistered',
                'Sole Proprietorship',
                'Limited Partnership',
                'Limited Company',
                'Cooperative'
            ],
            self::NIB_OWNERSHIP => [
                'Memiliki NIB',
                'Belum Memiliki NIB'
            ],
            self::MONTHLY_TURNOVER => [
                'Mikro (< 5 Juta)',
                'Kecil (5 - 15 Juta)',
                'Menengah (> 15 Juta)'
            ],
            self::DIGITAL_TRANSACTION => [
                'Menggunakan QRIS/E-Wallet',
                'Tunai / Cash Only'
            ],
            self::DIGITAL_PLATFORM => [
                'None',
                'Social Media',
                'Ecommerce',
                'Delivery App',
                'Ride Hailing'
            ],
            self::CAPITAL_SOURCE => [
                'Personal',
                'Bank Loan',
                'Goverment Credit',
                'Goverment Grant',
                'Family Relative'
            ],
            self::ECO_FRIENDLY => [
                'Ramah Lingkungan',
                'Belum Standar Teknis'
            ],
            self::BUMDES_PARTNERSHIP => [
                'None',
                'Consigment Product',
                'Raw Material Supply',
                'Capital Invesment',
                'Marketing Cooperation'
            ],
        };
    }
}
