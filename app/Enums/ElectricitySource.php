<?php

namespace App\Enums;

enum ElectricitySource: string
{
    case PLN_METERED = 'pln_metered';
    case PLN_UNMETERED = 'pln_unmetered';
    case NON_PLN = 'non_pln';
    case NO_ELECTRICITY = 'no_electricity';

    public function label(): string
    {
        return match ($this) {
            self::PLN_METERED => 'PLN Meteran',
            self::PLN_UNMETERED => 'PLN Non Meteran',
            self::NON_PLN => 'Non PLN',
            self::NO_ELECTRICITY => 'Tidak Ada Listrik',
        };
    }
}
