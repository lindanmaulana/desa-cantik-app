<?php

namespace App\Enums;

enum HouseOwnership: string {
    case OWNED = 'owned';
    case RENTED = 'rented';
    case FREE_RENT = 'free_rent';
    case OFFICIAL_HOUSE = 'official_house';

    public function label(): string {
        return match($this) {
            self::OWNED => 'Dimiliki',
            self::RENTED => 'Disewa',
            self::FREE_RENT => 'Sewa Gratis',
            self::OFFICIAL_HOUSE => "Rumah Resmi",
        };
    }
}
