<?php

namespace App\Enums;

enum InfrastructureType: string
{
    case FACILITY_TYPE = 'facility_type';
    case CONDITION = 'condition';
    case CONSTRUCTION_YEAR = 'construction_year';

    public function title(): string
    {
        return match ($this) {
            self::FACILITY_TYPE => 'Jenis Fasilitas Publik',
            self::CONDITION => 'Kondisi Kelayakan Fisik',
            self::CONSTRUCTION_YEAR => 'Tren Tahun Pembangunan',
        };
    }

    public function chartType(): string
    {
        return match ($this) {
            self::CONSTRUCTION_YEAR => 'bar',

            self::FACILITY_TYPE,
            self::CONDITION => 'donut',
        };
    }

    public function options(): array
    {
        return match ($this) {
            self::FACILITY_TYPE => [
                'road' => 'Jalan',
                'bridge' => 'Jembatan',
                'irrigation' => 'Irigasi',
                'education' => 'Sarana Pendidikan',
                'health' => 'Sarana Kesehatan',
                'worship' => 'Tempat Ibadah',
                'goverment' => 'Fasilitas Pemerintahan',
            ],
            self::CONDITION => [
                'good' => 'Baik',
                'damaged_light' => 'Rusak Ringan',
                'damaged_severe' => 'Rusak Berat',
            ],
            self::CONSTRUCTION_YEAR => []
        };
    }
}
