<?php

namespace App\Enums;

enum DemographicsType: string
{
    case AGE_GROUP = 'ageGroup';
    case GENDER = 'gender';
    case MARITAL_STATUS = 'maritalStatus';
    case TERRITORY = 'territory';
    case CITIZEN_STATUS = 'citizenStatus';
    case FAMILY_RELATIONSHIP = 'familyRelationship';
    case KTP_OWNERSHIP = 'ktpOwnership';
    case BUILDING_DENSITY = 'buildingDensity';

    public function chartType(): string
    {
        return match ($this) {
            self::AGE_GROUP => 'bar',
            self::GENDER => 'donut',
            self::MARITAL_STATUS => 'donut',
            self::TERRITORY => 'bar',
            self::CITIZEN_STATUS => 'bar',
        };
    }

    public function labels(): array
    {
        return match ($this) {
            self::AGE_GROUP => [ 'Balita (0-4)', 'Anak-anak (5-14)', 'Remaja (15-24)', 'Dewasa Produktif (25-54)', 'Pra Lansia (55-64)', 'Lansia (65+)', 'Tidak Diisi' ],
            self::GENDER => ["Laki-Laki", "Perempuan"],
            self::MARITAL_STATUS => ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'],
            self::TERRITORY => ['Keberadaan'],
            self::CITIZEN_STATUS => ['Kepala Keluarga', 'Suami / Istri', 'Anak', 'Orang Tua', 'Famili lain'],
            self::FAMILY_RELATIONSHIP => ['Hubungan dgn KK'],
            self::KTP_OWNERSHIP => ['Kepemilikan KTP-el'],
            self::BUILDING_DENSITY => ['Kepadatan Bangunan'],
        };
    }
}
