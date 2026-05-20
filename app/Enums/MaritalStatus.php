<?php

namespace App\Enums;

enum MaritalStatus: string {
    case SINGLE = 'single';
    case MARRIED = 'married';
    case DIVORCED = 'divorced';
    case WIDOWED = 'widowed';

    public function label(): string {
        return match($this) {
            self::SINGLE => 'Belum Kawin',
            self::MARRIED => 'Kawin',
            self::DIVORCED => 'Cerai Hidup',
            self::WIDOWED => 'Cerai Mati',
        };
    }
}
