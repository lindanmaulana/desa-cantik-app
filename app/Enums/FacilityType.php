<?php

namespace App\Enums;

enum FacilityType: string {
    case ROAD = 'road';
    case BRIDGE = 'bridge';
    case IRRIGATION = 'irrigation';
    case EDUCATION = 'education';
    case HEALTH = 'health';
    case WORSHIP = 'worship';
    case GOVERMENT = 'goverment';


    public function label(): string {
        return match($this) {
            self::ROAD => 'Jalanan Desa',
            self::BRIDGE => 'Jembatan Umum',
            self::IRRIGATION => 'Saluran Irigasi',
            self::EDUCATION => 'Sarana Pendidikan',
            self::HEALTH => 'Saranan Kesehatan',
            self::WORSHIP => 'Tempat Ibadah',
            self::GOVERMENT => 'Kantor Pemerintahan'
        };
    }
}
