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

        $rawQuery =  Citizen::selectRaw("
            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 4 THEN 1 ELSE 0 END) as male_toddlers,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 0 AND 4 THEN 1 ELSE 0 END) as female_toddlers,

            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 14 THEN 1 ELSE 0 END) as male_children,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 5 AND 14 THEN 1 ELSE 0 END) as female_children,

            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 15 AND 24 THEN 1 ELSE 0 END) as male_teenagers,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 15 AND 24 THEN 1 ELSE 0 END) as female_teenagers,

            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 25 AND 54 THEN 1 ELSE 0 END) as male_adults,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 25 AND 54 THEN 1 ELSE 0 END) as female_adults,

            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 55 AND 64 THEN 1 ELSE 0 END) as male_pre_seniors,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 55 AND 64 THEN 1 ELSE 0 END) as female_pre_seniors,

            SUM(CASE WHEN gender = 'male' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 65 THEN 1 ELSE 0 END) as male_seniors,
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 65 THEN 1 ELSE 0 END) as female_seniors
        ")->first();

        return [
            'male' => [
                $rawQuery->male_pre_seniors ?? 0,
                $rawQuery->male_adults ?? 0,
                $rawQuery->male_seniors ?? 0,
                $rawQuery->male_toddlers ?? 0,
                $rawQuery->male_children ?? 0,
                $rawQuery->male_teenagers ?? 0,
                0,
            ],
            'female' => [
                $rawQuery->female_pre_seniors ?? 0,
                $rawQuery->female_adults ?? 0,
                $rawQuery->female_seniors ?? 0,
                $rawQuery->female_toddlers ?? 0,
                $rawQuery->female_children ?? 0,
                $rawQuery->female_teenagers ?? 0,
                0
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
}
