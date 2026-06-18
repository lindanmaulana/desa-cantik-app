<?php

namespace App\Enums;

enum SocialType: string
{
    case RELIGION = 'religion';
    case SCHOOL_PARTICIPATION = 'school_participation';
    case EDUCATION_LEVEL = 'education_level';
    case HIGHEST_DIPLOMA = 'highest_diploma';
    case BLOOD_TYPE = 'blood_type';
    case DISABILITY = 'disability';
    case PREGNANCY = 'pregnancy';
    case FAMILY_PLANNING = 'family_planning';
    case BPJS_STATUS = 'bpjs_status';
    case WELFARE_ASSISTANCE = 'welfare_assistance';
    case SANITATION = 'sanitation_type';
    case WATER_SOURCE = 'water_source';
    case ELECTRICITY_SOURCE = 'electricity_source';
    case ELECTRICITY_CAPACITY = 'electricity_capacity';

    /**
     * Menentukan tipe komponen chart yang akan dirender di frontend
     */
    public function chartType(): string
    {
        return match ($this) {
            self::RELIGION,
            self::EDUCATION_LEVEL,
            self::HIGHEST_DIPLOMA,
            self::FAMILY_PLANNING,
            self::BPJS_STATUS,
            self::WELFARE_ASSISTANCE,
            self::SANITATION,
            self::WATER_SOURCE,
            self::ELECTRICITY_SOURCE,
            self::ELECTRICITY_CAPACITY => 'bar',

            // self::DISABILITY,
            // self::WATER_SOURCE => 'bar',

            // self::HIGHEST_DIPLOMA,
            // self::FAMILY_PLANNING,
            // self::PREGNANCY,
            // self::SANITATION => 'donut',

            // self::EDUCATION_LEVEL,
            // self::BLOOD_TYPE,
            // self::BPJS_STATUS,
            // self::WELFARE_ASSISTANCE,
            // self::ELECTRICITY_CAPACITY => 'bar',

            self::SCHOOL_PARTICIPATION,
            self::BLOOD_TYPE,
            self::DISABILITY,
            self::PREGNANCY => 'donut',
        };
    }

    /**
     * Menerjemahkan opsi sub-kategori database menjadi teks label UI Dashboard
     */
    public function labels(): array
    {
        return match ($this) {
            self::RELIGION => [
                'Islam',
                'Kristen (Protestan)',
                'Katolik',
                'Hindu',
                'Buddha',
                'Khonghucu',
                'Lainnya'
            ],
            self::SCHOOL_PARTICIPATION => [
                'Belum / Tidak Sekolah',
                'Sedang Sekolah',
                'Tidak Sekolah Lagi'
            ],
            self::EDUCATION_LEVEL => [
                'Tidak/Belum Sekolah',
                'SD / Sederajat',
                'SMP / Sederajat',
                'SMA / Sederajat',
                'Diploma (D1/D2/D3)',
                'Sarjana (S1/D4)',
                'Magister (S2)',
                'Doktor (S3)'
            ],
            self::HIGHEST_DIPLOMA => [
                'Tanpa Ijazah',
                'Ijazah SD',
                'Ijazah SMP',
                'Ijazah SMA',
                'Ijazah PT / Diploma'
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
            self::WELFARE_ASSISTANCE => [
                'PKH',
                'BLT Dana Desa',
                'Bansos Pangan',
                'KIP / Beasiswa',
                'Lainnya'
            ],
            self::WATER_SOURCE => [
                'Air Leding (PAM/PDAM)',
                'Sumur Terlindungi',
                'Sumur Bor/Pompa',
                'Mata Air',
                'Air Sungai/Hujan'
            ],
            self::ELECTRICITY_SOURCE => [
                'PLN Meteran (Pasca/Prabayar)',
                'PLN Non-Meteran',
                'Non-PLN (Mandiri/Solar)',
                'Tidak Ada Penerangan/Listrik'
            ],
            self::ELECTRICITY_CAPACITY => [
                'Listrik PLN 450 VA',
                'Listrik PLN 900 VA',
                'Listrik PLN >= 1300 VA',
                'Non-PLN',
                'Tidak Ada Listrik'
            ],
            self::SANITATION => [
                'Jamban Sendiri',
                'Jamban Bersama',
                'Jamban Cemplung/Cubluk',
                'Tidak Ada Toilet'
            ],
        };
    }

    public function title(): string
    {
        return match ($this) {
            self::RELIGION               => 'Agama',
            self::SCHOOL_PARTICIPATION   => 'Partisipasi Sekolah',
            self::EDUCATION_LEVEL        => 'Jenjang Pendidikan',
            self::HIGHEST_DIPLOMA        => 'Ijazah Terakhir',
            self::BLOOD_TYPE             => 'Golongan Darah',
            self::DISABILITY             => 'Disabilitas',
            self::PREGNANCY              => 'Kehamilan',
            self::FAMILY_PLANNING        => 'Keluarga Berencana',
            self::BPJS_STATUS            => 'BPJS Kesehatan',
            self::WELFARE_ASSISTANCE     => 'Bantuan Sosial',
            self::WATER_SOURCE           => 'Sumber Air',
            self::ELECTRICITY_SOURCE     => 'Sumber Energi Penerangan',
            self::ELECTRICITY_CAPACITY   => 'Kapasitas Daya Listrik',
            self::SANITATION             => 'Fasilitas BAB',
        };
    }
}
