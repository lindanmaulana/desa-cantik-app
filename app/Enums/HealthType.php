<?php

namespace App\Enums;

enum HealthType: string
{
    case STUNTING_STATUS = 'stunting_status';
    case NUTRITIONAL_STATUS = 'nutritional_status';
    case PREGNANCY = 'pregnancy';
    case FAMILY_PLANNING = 'family_planning';
    case BPJS_STATUS = 'bpjs_status';
    case BLOOD_TYPE = 'blood_type';
    case DISABILITY = 'disability';

    public function chartType(): string
    {
        return match ($this) {
            self::BPJS_STATUS => 'bar',

            self::STUNTING_STATUS,
            self::NUTRITIONAL_STATUS,
            self::PREGNANCY,
            self::FAMILY_PLANNING,
            self::BLOOD_TYPE,
            self::DISABILITY => 'donut',
        };
    }

    public function labels(): array
    {
        return match ($this) {
            self::STUNTING_STATUS => [
                'Stunting (Sangat Pendek)',
                'Stunting (Pendek)',
                'Normal (Bukan Stunting)'
            ],
            self::NUTRITIONAL_STATUS => [
                'Gizi Buruk (Severely Wasted)',
                'Gizi Kurang (Wasted)',
                'Gizi Baik (Normal)',
                'Risiko Gizi Lebih (Overweight)'
            ],
            self::PREGNANCY => [
                'Hamil (Aktif Pemeriksaan)',
                'Hamil (Beresiko/Butuh Perhatian)'
            ],
            self::FAMILY_PLANNING => [
                'Suntik',
                'Pil',
                'Kondom',
                'Implant',
                'IUD',
                'MOW (Tubektomi)',
                'MOP (Vasektomi)'
            ],
            self::BPJS_STATUS => [
                'Tidak Ada / Belum Tercover',
                'PBI (Subsidi Pemerintah)',
                'Mandiri',
                'PPU (Pekerja Penerima Upah)'
            ],
            self::BLOOD_TYPE => [
                'A',
                'B',
                'AB',
                'O',
                'A+',
                'A-',
                'B+',
                'B-',
                'AB+',
                'AB-',
                'O+',
                'O-',
                'Tidak Tahu'
            ],
            self::DISABILITY => [
                'Fisik',
                'Intelektual',
                'Mental',
                'Sensorik'
            ],
        };
    }

    public function title(): string
    {
        return match ($this) {
            self::STUNTING_STATUS    => 'Status Stunting Balita',
            self::NUTRITIONAL_STATUS  => 'Status Gizi Balita (PPM)',
            self::PREGNANCY          => 'Kehamilan Warga',
            self::FAMILY_PLANNING     => 'Keluarga Berencana (KB)',
            self::BPJS_STATUS         => 'Jaminan Kesehatan (BPJS)',
            self::BLOOD_TYPE         => 'Golongan Darah Warga',
            self::DISABILITY         => 'Penyandang Disabilitas',
        };
    }
}
