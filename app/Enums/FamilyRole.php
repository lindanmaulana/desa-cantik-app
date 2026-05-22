<?php

namespace App\Enums;


enum FamilyRole: string
{
    case HEAD_OF_FAMILY = 'head_of_family';
    case SPOUSE = 'spouse';
    case CHILD = 'child';
    case PARENT = 'parent';
    case OTHER_RELATIVE = 'other_relative';

    public function label(): string {
        return match($this) {
            self::HEAD_OF_FAMILY => 'Kepala Keluarga',
            self::SPOUSE => 'Suami / Istri',
            self::CHILD => 'Anak',
            self::PARENT => 'Orang Tua',
            self::OTHER_RELATIVE => 'Famili Lain',
        };
    }
}
