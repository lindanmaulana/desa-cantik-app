<?php

namespace App\Services\Statistics;

use App\Enums\SocialType;
use App\Models\Citizen;
use App\Models\Family;

class SocialService
{
    public function getSocialStats()
    {
        return Citizen::query()
            ->leftJoin('health_profiles', 'citizens.id', '=', 'health_profiles.citizen_id')
            ->selectRaw("
            -- 1. Menghitung total warga penyandang disabilitas (bukan 'none' dan tidak null)
            SUM(CASE WHEN health_profiles.disability_type IS NOT NULL AND health_profiles.disability_type != 'none' THEN 1 ELSE 0 END) as total_disabilities,

            -- 2. Menghitung warga dengan golongan darah terdata resmi (bukan 'unknown', '-', atau null)
            SUM(CASE WHEN citizens.blood_type IS NOT NULL AND citizens.blood_type NOT IN ('-', 'unknown') THEN 1 ELSE 0 END) as total_blood_registered,

            -- 3. Menghitung total variasi agama unik di desa
            COUNT(DISTINCT citizens.religion) as total_religions,

            -- 4. Menghitung total KK yang memiliki jamban sendiri atau jamban bersama (Sub-query yang sinkron ke housing_profiles)
            (SELECT COUNT(*)
             FROM families
             JOIN housing_profiles ON families.id = housing_profiles.family_id
             WHERE housing_profiles.sanitation_type IN ('private_flush_toilet', 'shared_flush_toilet')
            ) as total_sanitation_covered
        ")
            ->first();
    }

    public function getReligion(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN religion = 'islam' THEN 1 ELSE 0 END) as islam,
            SUM(CASE WHEN religion = 'protestant' THEN 1 ELSE 0 END) as protestant,
            SUM(CASE WHEN religion = 'catholic' THEN 1 ELSE 0 END) as catholic,
            SUM(CASE WHEN religion = 'hindu' THEN 1 ELSE 0 END) as hindu,
            SUM(CASE WHEN religion = 'buddha' THEN 1 ELSE 0 END) as buddha,
            SUM(CASE WHEN religion = 'confucian' THEN 1 ELSE 0 END) as confucian,
            SUM(CASE WHEN religion = 'others' OR religion IS NULL THEN 1 ELSE 0 END) as others
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        $labels = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'];

        return [
            'labels' => $labels,
            'datasets' => [
                (int) $rawQuery->sum('islam'),
                (int) $rawQuery->sum('protestant'),
                (int) $rawQuery->sum('catholic'),
                (int) $rawQuery->sum('hindu'),
                (int) $rawQuery->sum('buddha'),
                (int) $rawQuery->sum('confucian'),
                (int) $rawQuery->sum('others'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->islam ?? 0),
                    (int) ($row->protestant ?? 0),
                    (int) ($row->catholic ?? 0),
                    (int) ($row->hindu ?? 0),
                    (int) ($row->buddha ?? 0),
                    (int) ($row->confucian ?? 0),
                    (int) ($row->others ?? 0),
                ]
            ])->all()
        ];
    }


    public function getSchoolParticipation(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("education_profiles", "citizens.id", "=", "education_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
        COALESCE(territories.rw, 'Tanpa RW') as rw,
        COALESCE(territories.rt, 'Tanpa RT') as rt,

        -- 💡 PENGAMAN 1: Menghitung yang berstatus 'not_yet_in_school'
        SUM(CASE WHEN education_profiles.school_participation = 'not_yet_in_school' THEN 1 ELSE 0 END) as not_yet,

        -- 💡 PENGAMAN 2: Menghitung yang berstatus 'currently_in_school'
        SUM(CASE WHEN education_profiles.school_participation = 'currently_in_school' THEN 1 ELSE 0 END) as currently,

        -- 💡 PENGAMAN 3: Gabungkan status 'no_longer_in_school', data NULL, atau string kosong agar tidak ada warga yang hilang dari hitungan
        SUM(CASE
            WHEN education_profiles.school_participation = 'no_longer_in_school' THEN 1
            WHEN education_profiles.school_participation IS NULL THEN 1
            ELSE 0
        END) as no_longer
    ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => SocialType::SCHOOL_PARTICIPATION->labels(),
            'datasets' => [
                (int) $rawQuery->sum('not_yet'),
                (int) $rawQuery->sum('currently'),
                (int) $rawQuery->sum('no_longer'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->not_yet ?? 0),
                    (int) ($row->currently ?? 0),
                    (int) ($row->no_longer ?? 0),
                ]
            ])->all()
        ];
    }

    public function getEducationLevel(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("education_profiles", "citizens.id", "=", "education_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id") // Sesuai penamaan relasi
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,

            -- 1. Tidak / Belum Sekolah (none atau data NULL jika belum di-profile)
            SUM(CASE
                WHEN education_profiles.education_level = 'none' THEN 1
                WHEN education_profiles.education_level IS NULL THEN 1
                ELSE 0
            END) as none,

            -- 2. SD / Sederajat
            SUM(CASE WHEN education_profiles.education_level = 'elementary_school' THEN 1 ELSE 0 END) as elementary,

            -- 3. SMP / Sederajat
            SUM(CASE WHEN education_profiles.education_level = 'middle_school' THEN 1 ELSE 0 END) as middle,

            -- 4. SMA / Sederajat
            SUM(CASE WHEN education_profiles.education_level = 'high_school' THEN 1 ELSE 0 END) as high,

            -- 5. Diploma (Associate Degree)
            SUM(CASE WHEN education_profiles.education_level = 'associate_degree' THEN 1 ELSE 0 END) as associate,

            -- 6. Sarjana (Bachelor Degree)
            SUM(CASE WHEN education_profiles.education_level = 'bachelor_degree' THEN 1 ELSE 0 END) as bachelor,

            -- 7 & 8. Pascasarjana (Postgraduate / Magister & Doktor jika disatukan oleh Enum)
            SUM(CASE WHEN education_profiles.education_level = 'postgraduate' THEN 1 ELSE 0 END) as postgraduate
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            // Mengambil pemetaan label teks dari Enum SocialType milikmu
            'labels' => SocialType::EDUCATION_LEVEL->labels(),
            'datasets' => [
                (int) $rawQuery->sum('none'),
                (int) $rawQuery->sum('elementary'),
                (int) $rawQuery->sum('middle'),
                (int) $rawQuery->sum('high'),
                (int) $rawQuery->sum('associate'),
                (int) $rawQuery->sum('bachelor'),
                (int) $rawQuery->sum('postgraduate'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->none ?? 0),
                    (int) ($row->elementary ?? 0),
                    (int) ($row->middle ?? 0),
                    (int) ($row->high ?? 0),
                    (int) ($row->associate ?? 0),
                    (int) ($row->bachelor ?? 0),
                    (int) ($row->postgraduate ?? 0),
                ]
            ])->all()
        ];
    }

    public function getHighestDiploma(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("education_profiles", "citizens.id", "=", "education_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,

            -- 1. Tanpa Ijazah (none atau data NULL jika belum di-profile)
            SUM(CASE
                WHEN education_profiles.highest_diploma = 'none' THEN 1
                WHEN education_profiles.highest_diploma IS NULL THEN 1
                ELSE 0
            END) as none,

            -- 2. Ijazah SD
            SUM(CASE WHEN education_profiles.highest_diploma = 'elementary_school' THEN 1 ELSE 0 END) as elementary,

            -- 3. Ijazah SMP
            SUM(CASE WHEN education_profiles.highest_diploma = 'middle_school' THEN 1 ELSE 0 END) as middle,

            -- 4. Ijazah SMA
            SUM(CASE WHEN education_profiles.highest_diploma = 'high_school' THEN 1 ELSE 0 END) as high,

            -- 5. Ijazah Diploma (Associate Degree)
            SUM(CASE WHEN education_profiles.highest_diploma = 'associate_degree' THEN 1 ELSE 0 END) as associate,

            -- 6. Ijazah Sarjana (Bachelor Degree)
            SUM(CASE WHEN education_profiles.highest_diploma = 'bachelor_degree' THEN 1 ELSE 0 END) as bachelor,

            -- 7. Ijazah Pascasarjana (Postgraduate)
            SUM(CASE WHEN education_profiles.highest_diploma = 'postgraduate' THEN 1 ELSE 0 END) as postgraduate
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => SocialType::HIGHEST_DIPLOMA->labels(),
            'datasets' => [
                (int) $rawQuery->sum('none'),
                (int) $rawQuery->sum('elementary'),
                (int) $rawQuery->sum('middle'),
                (int) $rawQuery->sum('high'),
                (int) $rawQuery->sum('associate'),
                (int) $rawQuery->sum('bachelor'),
                (int) $rawQuery->sum('postgraduate'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->none ?? 0),
                    (int) ($row->elementary ?? 0),
                    (int) ($row->middle ?? 0),
                    (int) ($row->high ?? 0),
                    (int) ($row->associate ?? 0),
                    (int) ($row->bachelor ?? 0),
                    (int) ($row->postgraduate ?? 0),
                ]
            ])->all()
        ];
    }

    public function getSocialAssistanceStatus(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            // Gabung ke tabel employment_profiles sesuai dengan dokumen spesifikasi kamu
            ->leftJoin("employment_profiles", "citizens.id", "=", "employment_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,

            -- 1. Program Keluarga Harapan (PKH)
            SUM(CASE
                WHEN employment_profiles.is_welfare_recipient = 1
                     AND LOWER(employment_profiles.assistance_type) LIKE '%pkh%'
                THEN 1 ELSE 0
            END) as pkh_count,

            -- 2. Bantuan Pangan Non Tunai (BPNT / Sembako)
            SUM(CASE
                WHEN employment_profiles.is_welfare_recipient = 1
                     AND (LOWER(employment_profiles.assistance_type) LIKE '%bpnt%' OR LOWER(employment_profiles.assistance_type) LIKE '%sembako%')
                THEN 1 ELSE 0
            END) as bpnt_count,

            -- 3. Bantuan Langsung Tunai (BLT)
            SUM(CASE
                WHEN employment_profiles.is_welfare_recipient = 1
                     AND LOWER(employment_profiles.assistance_type) LIKE '%blt%'
                THEN 1 ELSE 0
            END) as blt_count,

            -- 4. Bantuan Lainnya (Penerima bansos yang jenisnya tidak termasuk PKH/BPNT/BLT atau string kosong)
            SUM(CASE
                WHEN employment_profiles.is_welfare_recipient = 1
                     AND LOWER(employment_profiles.assistance_type) NOT LIKE '%pkh%'
                     AND LOWER(employment_profiles.assistance_type) NOT LIKE '%bpnt%'
                     AND LOWER(employment_profiles.assistance_type) NOT LIKE '%sembako%'
                     AND LOWER(employment_profiles.assistance_type) NOT LIKE '%blt%'
                THEN 1 ELSE 0
            END) as other_count
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => ['PKH', 'BPNT', 'BLT', 'Bantuan Lainnya'],
            'datasets' => [
                (int) $rawQuery->sum('pkh_count'),
                (int) $rawQuery->sum('bpnt_count'),
                (int) $rawQuery->sum('blt_count'),
                (int) $rawQuery->sum('other_count'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tan放 RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->pkh_count ?? 0),
                    (int) ($row->bpnt_count ?? 0),
                    (int) ($row->blt_count ?? 0),
                    (int) ($row->other_count ?? 0),
                ]
            ])->all()
        ];
    }

    public function getSanitation(?string $rw = null, ?string $rt = null)
    {
        // Asumsi relasi: Family memiliki housing_profile (one-to-one atau join langsung)
        $query = Family::query()
            ->leftJoin("housing_profiles", "families.id", "=", "housing_profiles.family_id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN housing_profiles.sanitation_type = 'private_flush_toilet' THEN 1 ELSE 0 END) as private_flush,
            SUM(CASE WHEN housing_profiles.sanitation_type = 'shared_flush_toilet' THEN 1 ELSE 0 END) as shared_flush,
            SUM(CASE WHEN housing_profiles.sanitation_type = 'pit_latrine' THEN 1 ELSE 0 END) as pit_latrine,
            SUM(CASE WHEN housing_profiles.sanitation_type = 'no_toilet' THEN 1 ELSE 0 END) as no_toilet
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => SocialType::SANITATION->labels(),
            'datasets' => [
                (int) $rawQuery->sum('private_flush'),
                (int) $rawQuery->sum('shared_flush'),
                (int) $rawQuery->sum('pit_latrine'),
                (int) $rawQuery->sum('no_toilet'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->private_flush ?? 0),
                    (int) ($row->shared_flush ?? 0),
                    (int) ($row->pit_latrine ?? 0),
                    (int) ($row->no_toilet ?? 0),
                ]
            ])->all()
        ];
    }

    public function getWaterSource(?string $rw = null, ?string $rt = null)
    {
        $query = Family::query()
            // Gabung ke tabel housing_profiles
            ->leftJoin("housing_profiles", "families.id", "=", "housing_profiles.family_id")
            // Menggunakan nama tabel asli database: territories
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,

            -- 1. Piped Water (Air Pipa / PDAM)
            SUM(CASE WHEN housing_profiles.water_source = 'piped_water' THEN 1 ELSE 0 END) as piped_count,

            -- 2. Protected Well (Sumur Terlindung)
            SUM(CASE WHEN housing_profiles.water_source = 'protected_well' THEN 1 ELSE 0 END) as protected_well_count,

            -- 3. Bore Well (Sumur Bor)
            SUM(CASE WHEN housing_profiles.water_source = 'bore_well' THEN 1 ELSE 0 END) as bore_well_count,

            -- 4. Spring Water (Mata Air)
            SUM(CASE WHEN housing_profiles.water_source = 'spring_water' THEN 1 ELSE 0 END) as spring_count,

            -- 5. River / Rainwater (Sungai / Air Hujan)
            SUM(CASE WHEN housing_profiles.water_source = 'river_rainwater' THEN 1 ELSE 0 END) as river_rain_count
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => ['Air Pipa (PDAM)', 'Sumur Terlindung', 'Sumur Bor', 'Mata Air', 'Sungai/Air Hujan'],
            'datasets' => [
                (int) $rawQuery->sum('piped_count'),
                (int) $rawQuery->sum('protected_well_count'),
                (int) $rawQuery->sum('bore_well_count'),
                (int) $rawQuery->sum('spring_count'),
                (int) $rawQuery->sum('river_rain_count'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->piped_count ?? 0),
                    (int) ($row->protected_well_count ?? 0),
                    (int) ($row->bore_well_count ?? 0),
                    (int) ($row->spring_count ?? 0),
                    (int) ($row->river_rain_count ?? 0),
                ]
            ])->all()
        ];
    }

    public function getElectricitySource(?string $rw = null, ?string $rt = null)
    {
        $query = Family::query()
            ->leftJoin("housing_profiles", "families.id", "=", "housing_profiles.family_id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN housing_profiles.electricity_source = 'pln_metered' THEN 1 ELSE 0 END) as pln_metered_count,
            SUM(CASE WHEN housing_profiles.electricity_source = 'pln_unmetered' THEN 1 ELSE 0 END) as pln_unmetered_count,
            SUM(CASE WHEN housing_profiles.electricity_source = 'non_pln' THEN 1 ELSE 0 END) as non_pln_count,
            SUM(CASE WHEN housing_profiles.electricity_source = 'no_electricity' THEN 1 ELSE 0 END) as no_elec_count
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => ['PLN Meteran (Pasca/Prabayar)', 'PLN Non-Meteran', 'Non-PLN (Mandiri/Solar)', 'Tidak Ada Penerangan/Listrik'],
            'datasets' => [
                (int) $rawQuery->sum('pln_metered_count'),
                (int) $rawQuery->sum('pln_unmetered_count'),
                (int) $rawQuery->sum('non_pln_count'),
                (int) $rawQuery->sum('no_elec_count'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->pln_metered_count ?? 0),
                    (int) ($row->pln_unmetered_count ?? 0),
                    (int) ($row->non_pln_count ?? 0),
                    (int) ($row->no_elec_count ?? 0),
                ]
            ])->all()
        ];
    }

    public function getElectricityCapacity(?string $rw = null, ?string $rt = null)
    {
        $query = Family::query()
            ->leftJoin("housing_profiles", "families.id", "=", "housing_profiles.family_id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN housing_profiles.electricity_capacity = '450va' THEN 1 ELSE 0 END) as cap_450_count,
            SUM(CASE WHEN housing_profiles.electricity_capacity = '900va' THEN 1 ELSE 0 END) as cap_900_count,
            SUM(CASE WHEN housing_profiles.electricity_capacity = '1300va' THEN 1 ELSE 0 END) as cap_1300_count,
            SUM(CASE WHEN housing_profiles.electricity_capacity = '2200va' THEN 1 ELSE 0 END) as cap_2200_count,
            SUM(CASE WHEN housing_profiles.electricity_capacity = 'above_2200va' THEN 1 ELSE 0 END) as cap_above_count,
            SUM(CASE WHEN housing_profiles.electricity_capacity = 'non_electricity' OR housing_profiles.electricity_capacity IS NULL THEN 1 ELSE 0 END) as no_cap_count
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => ['Daya 450 VA', 'Daya 900 VA', 'Daya 1300 VA', 'Daya 2200 VA', 'Daya di atas 2200 VA', 'Tanpa Daya Listrik'],
            'datasets' => [
                (int) $rawQuery->sum('cap_450_count'),
                (int) $rawQuery->sum('cap_900_count'),
                (int) $rawQuery->sum('cap_1300_count'),
                (int) $rawQuery->sum('cap_2200_count'),
                (int) $rawQuery->sum('cap_above_count'),
                (int) $rawQuery->sum('no_cap_count'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->cap_450_count ?? 0),
                    (int) ($row->cap_900_count ?? 0),
                    (int) ($row->cap_1300_count ?? 0),
                    (int) ($row->cap_2200_count ?? 0),
                    (int) ($row->cap_above_count ?? 0),
                    (int) ($row->no_cap_count ?? 0),
                ]
            ])->all()
        ];
    }
}
