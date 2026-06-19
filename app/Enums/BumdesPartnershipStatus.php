<?php

namespace App\Enums;

enum BumdesPartnershipStatus: string
{
    case NONE = 'none';
    case CONSIGNMENT_PRODUCT = 'consigment_product';
    case RAW_MATERIAL_SUPPLY = 'raw_material_supply';
    case CAPITAL_INVESTMENT = 'capital_invesment';
    case MARKETING_COOPERATION = 'marketing_cooperation';

    public function label(): string
    {
        return match ($this) {
            self::NONE => 'Tidak Ada Kemitraan',
            self::CONSIGNMENT_PRODUCT => 'Produk Konsinyasi (Titip Jual)',
            self::RAW_MATERIAL_SUPPLY => 'Pasokan Bahan Baku',
            self::CAPITAL_INVESTMENT => 'Penyertaan / Investasi Modal',
            self::MARKETING_COOPERATION => 'Kerjasama Pemasaran',
        };
    }
}
