<?php

namespace App\Enums;

enum EconomicType: string
{
    case OCCUPATION = 'occupation';
    case JOB_SECTOR = 'job_sector';
    case EMPLOYMENT_STATUS = 'employment_status';
    case HOUSE_OWNERSHIP = 'house_ownership';
    case FLOOR_MATERIAL = 'floor_material';
    case WALL_MATERIAL = 'wall_material';
    case ROOF_MATERIAL = 'roof_material';
    case COOKING_FUEL = 'cooking_fuel';
    case ELECTRICITY_CAPACITY = 'electricity_capacity';
    case ELECTRICITY_SOURCE = 'electricity_source';
    case ECONOMIC_STATUS = 'economic_status';

    /**
     * Menentukan tipe komponen chart yang akan dirender di frontend
     */
    public function chartType(): string
    {
        return match ($this) {
            self::OCCUPATION,
            self::JOB_SECTOR,
            self::EMPLOYMENT_STATUS,
            self::FLOOR_MATERIAL,
            self::WALL_MATERIAL,
            self::ROOF_MATERIAL,
            self::ECONOMIC_STATUS => 'bar',

            self::HOUSE_OWNERSHIP,
            self::COOKING_FUEL,
            self::ELECTRICITY_SOURCE,
            self::ELECTRICITY_CAPACITY => 'donut',
        };
    }

    /**
     * Menerjemahkan opsi sub-kategori database menjadi teks label UI Dashboard
     * Catatan: Typo bawaan skema asal (seperti mansory_brick, goverment) ditangani langsung di sini.
     */
    public function labels(): array
    {
        return match ($this) {
            self::OCCUPATION => [],
            self::JOB_SECTOR           => collect(JobSector::cases())->map(fn($item) => $item->label())->all(),
            self::EMPLOYMENT_STATUS    => collect(EmploymentStatus::cases())->map(fn($item) => $item->label())->all(),
            self::HOUSE_OWNERSHIP      => collect(HouseOwnership::cases())->map(fn($item) => $item->label())->all(),
            self::FLOOR_MATERIAL       => collect(FloorMaterial::cases())->map(fn($item) => $item->label())->all(),
            self::WALL_MATERIAL        => collect(WallMaterial::cases())->map(fn($item) => $item->label())->all(),
            self::ROOF_MATERIAL        => collect(RoofMaterial::cases())->map(fn($item) => $item->label())->all(),
            self::COOKING_FUEL         => collect(CookingFuel::cases())->map(fn($item) => $item->label())->all(),
            self::ELECTRICITY_SOURCE   => collect(ElectricitySource::cases())->map(fn($item) => $item->label())->all(),
            self::ELECTRICITY_CAPACITY => collect(ElectricityCapacity::cases())->map(fn($item) => $item->label())->all(),
            self::ECONOMIC_STATUS      => collect(EconomicStatus::cases())->map(fn($item) => $item->label())->all(),
        };
    }

    public function title(): string
    {
        return match ($this) {
            self::OCCUPATION         => 'Pekerjaan Utama',
            self::JOB_SECTOR         => 'Sektor Usaha',
            self::EMPLOYMENT_STATUS  => 'Kedudukan Kerja',
            self::HOUSE_OWNERSHIP    => 'Status Rumah',
            self::FLOOR_MATERIAL     => 'Material Lantai',
            self::WALL_MATERIAL      => 'Material Dinding',
            self::ROOF_MATERIAL      => 'Material Atap',
            self::COOKING_FUEL       => 'Energi Masak',
            self::ELECTRICITY_SOURCE   => 'Sumber Listrik',
            self::ELECTRICITY_CAPACITY => 'Daya Listrik',
            self::ECONOMIC_STATUS    => 'Status Kesejahteraan Ekonomi',
        };
    }

    public function options(): array
    {
        return match ($this) {
            self::OCCUPATION => [],
            self::JOB_SECTOR => collect(JobSector::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::EMPLOYMENT_STATUS => collect(EmploymentStatus::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::HOUSE_OWNERSHIP => collect(HouseOwnership::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::FLOOR_MATERIAL => collect(FloorMaterial::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::WALL_MATERIAL => collect(WallMaterial::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::ROOF_MATERIAL => collect(RoofMaterial::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::COOKING_FUEL => collect(CookingFuel::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::ELECTRICITY_SOURCE => collect(ElectricitySource::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::ELECTRICITY_CAPACITY => collect(ElectricityCapacity::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
            self::ECONOMIC_STATUS => collect(EconomicStatus::cases())->mapWithKeys(fn($item) => [$item->value => $item->label()])->all(),
        };
    }
}
