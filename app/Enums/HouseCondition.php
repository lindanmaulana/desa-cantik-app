<?php

namespace App\Enums;

enum HouseCondition: string {
    case PROPER = 'proper';
    case UNFIT = 'unfit';

    public function label(): string {
        return match($this) {
            self::PROPER => 'Layak Huni',
            self::UNFIT => 'TIdak Layak Huni'
        };
    }
}
