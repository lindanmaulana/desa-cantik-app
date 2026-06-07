<?php

namespace App\Services\Statistics;

use App\Models\Citizen;

class DemographService
{
    public function getDemographicStats()
    {

        return Citizen::selectRaw("
            COUNT(*) as total_citizens,
            SUM(CASE WHEN gender = 'male' THEN 1 ELSE 0 END) as total_male,
            SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) as total_female,
            (SELECT COUNT(*) FROM families) as total_families
        ")->first();
    }

    public function getAgeGroup()
    {
        $rawQuery = Citizen::selectRaw("
            -- 1. BALITA (0 - 4)
            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 4 THEN 1 ELSE 0 END) as male_toddlers,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 4 THEN 1 ELSE 0 END) as female_toddlers,

            -- 2. ANAK-ANAK (5 - 14)
            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 14 THEN 1 ELSE 0 END) as male_children,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 14 THEN 1 ELSE 0 END) as female_children,

            -- 3. REMAJA (15 - 24)
            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 15 AND 24 THEN 1 ELSE 0 END) as male_teenagers,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 15 AND 24 THEN 1 ELSE 0 END) as female_teenagers,

            -- 4. DEWASA PRODUKTIF (25 - 54)
            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 25 AND 54 THEN 1 ELSE 0 END) as male_adults,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 25 AND 54 THEN 1 ELSE 0 END) as female_adults,

            -- 5. PRA LANSIA (55 - 64)
            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 55 AND 64 THEN 1 ELSE 0 END) as male_pre_seniors,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 55 AND 64 THEN 1 ELSE 0 END) as female_pre_seniors,

            -- 6. LANSIA (65+)
            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 65 THEN 1 ELSE 0 END) as male_seniors,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 65 THEN 1 ELSE 0 END) as female_seniors,

            -- 7. TIDAK DIISI / DATA TIDAK VALID (Dipisah berdasarkan gender agar klop dengan grafik)
            SUM(CASE WHEN (gender = 'male' OR gender NOT IN ('male', 'female') OR gender IS NULL)
                        AND (birth_date IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 0)
                        THEN 1 ELSE 0 END) as male_unmapped,

            SUM(CASE WHEN gender = 'female'
                        AND (birth_date IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 0)
                        THEN 1 ELSE 0 END) as female_unmapped
        ")->first();

        return [
            'male' => [
                $rawQuery->male_toddlers ?? 0,
                $rawQuery->male_children ?? 0,
                $rawQuery->male_teenagers ?? 0,
                $rawQuery->male_adults ?? 0,
                $rawQuery->male_pre_seniors ?? 0,
                $rawQuery->male_seniors ?? 0,
                $rawQuery->male_unmapped ?? 0,
            ],
            'female' => [
                $rawQuery->female_toddlers ?? 0,
                $rawQuery->female_children ?? 0,
                $rawQuery->female_teenagers ?? 0,
                $rawQuery->female_adults ?? 0,
                $rawQuery->female_pre_seniors ?? 0,
                $rawQuery->female_seniors ?? 0,
                $rawQuery->female_unmapped ?? 0,
            ],
            'raw' => $rawQuery
        ];
    }

    public function getGender()
    {
        $rawQuery =  Citizen::selectRaw("
            SUM(CASE WHEN gender = 'male'  THEN 1 ELSE 0 END) as total_male,
            SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) as total_female
        ")->first();

        return [
            'male' => $rawQuery->total_male ?? 0,
            'female' => $rawQuery->total_female ?? 0,
        ];
    }

    public function getMaritalStatus()
    {
        $rawQuery = Citizen::selectRaw("
            SUM(CASE WHEN marital_status = 'single' THEN 1 ELSE 0 END) as single,
            SUM(CASE WHEN marital_status = 'married' THEN 1 ELSE 0 END)  as married,
            SUM(CASE WHEN marital_status = 'divorced' THEN 1 ELSE 0 END)  as divorced,
            SUM(CASE WHEN marital_status = 'widowed' THEN 1 ELSE 0 END)  as widowed
        ")->first();


        return [
            'single' => $rawQuery->single ?? 0,
            'married' => $rawQuery->married ?? 0,
            'divorced' => $rawQuery->divorced ?? 0,
            'widowed' => $rawQuery->widowed ?? 0,
        ];
    }

    public function getTerritory($rw = null)
    {
        $query = Citizen::join('families', 'citizens.family_id', '=', 'families.id')
            ->join('territories', 'families.territory_id', '=', 'territories.id');

        if ($rw && $rw !== 'all') {
            return $query->where('territories.rw', $rw)
                ->selectRaw("
                COALESCE(NULLIF(territories.rt, ''), 'Tidak Diisi') as region_name,
                COUNT(citizens.id) as total_citizens
            ")
                ->groupBy('region_name')
                ->orderByRaw("CASE WHEN region_name = 'Tidak Diisi' THEN 1 ELSE 0 END, region_name ASC")
                ->get();
        }

        return $query->selectRaw("
            COALESCE(NULLIF(territories.rw, ''), 'Tidak Diisi') as region_name,
            COUNT(citizens.id) as total_citizens
        ")
            ->groupBy('region_name')
            ->orderByRaw("CASE WHEN region_name = 'Tidak Diisi' THEN 1 ELSE 0 END, region_name ASC")
            ->get();
    }
}
