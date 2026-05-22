<?php

namespace App\Enums;

enum FeatureType: string {
    case RESIDENT_HOUSE = 'resident_house';
    case PUBLIC_FACILITY = 'public_facility';
    case VILLAGE_BOUNDARY = 'village_boundary';
    case MSME_LOCATION = 'msme_location';

    public function label(): string {
        return match($this) {
            self::RESIDENT_HOUSE => 'Rumah Penduduk',
            self::PUBLIC_FACILITY => 'Fasilitas Publik',
            self::VILLAGE_BOUNDARY => 'Batas Wilayah Desa',
            self::MSME_LOCATION => 'Lokasi Usaha (UMKM)',
        };
    }
}
