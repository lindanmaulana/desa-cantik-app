<?php

namespace App\Services\Statistics;

use App\Models\Citizen;
use App\Models\Territory;

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

    public function getAgeGroup(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query();

        $query->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, function ($q) use ($rw) {
                return $q->where('territories.rw', $rw);
            })
            ->when($rt, function ($q) use ($rt) {
                return $q->where('territories.rt', $rt);
            });

        $rawQuery = $query->selectRaw("
            -- Kita berikan COALESCE agar jika RT/RW null, dia tertulis 'Tanpa Wilayah' di chart
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,

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

            -- 7. TIDAK DIISI / DATA TIDAK VALID
            SUM(CASE WHEN (gender = 'male' OR gender NOT IN ('male', 'female') OR gender IS NULL)
                        AND (birth_date IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 0)
                        THEN 1 ELSE 0 END) as male_unmapped,

            SUM(CASE WHEN gender = 'female'
                        AND (birth_date IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 0)
                        THEN 1 ELSE 0 END) as female_unmapped
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')
            ->orderBy('territories.rt')
            ->get();

        return [

            'male' => [
                (int) $rawQuery->sum('male_toddlers'),
                (int) $rawQuery->sum('male_children'),
                (int) $rawQuery->sum('male_teenagers'),
                (int) $rawQuery->sum('male_adults'),
                (int) $rawQuery->sum('male_pre_seniors'),
                (int) $rawQuery->sum('male_seniors'),
                (int) $rawQuery->sum('male_unmapped'),
            ],
            'female' => [
                (int) $rawQuery->sum('female_toddlers'),
                (int) $rawQuery->sum('female_children'),
                (int) $rawQuery->sum('female_teenagers'),
                (int) $rawQuery->sum('female_adults'),
                (int) $rawQuery->sum('female_pre_seniors'),
                (int) $rawQuery->sum('female_seniors'),
                (int) $rawQuery->sum('female_unmapped'),
            ],

            'by_territory' => $rawQuery->map(function ($row) {
                return [
                    'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW " . $row->rw . " / RT " . $row->rt,
                    'territory' => [
                        'rw' => $row->rw,
                        'rt' => $row->rt,
                    ],
                    'male' => [
                        (int) ($row->male_toddlers ?? 0),
                        (int) ($row->male_children ?? 0),
                        (int) ($row->male_teenagers ?? 0),
                        (int) ($row->male_adults ?? 0),
                        (int) ($row->male_pre_seniors ?? 0),
                        (int) ($row->male_seniors ?? 0),
                        (int) ($row->male_unmapped ?? 0),
                    ],
                    'female' => [
                        (int) ($row->female_toddlers ?? 0),
                        (int) ($row->female_children ?? 0),
                        (int) ($row->female_teenagers ?? 0),
                        (int) ($row->female_adults ?? 0),
                        (int) ($row->female_pre_seniors ?? 0),
                        (int) ($row->female_seniors ?? 0),
                        (int) ($row->female_unmapped ?? 0),
                    ],
                ];
            })->all(),
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
            'male' => [(int)$rawQuery->total_male ?? 0],
            'female' => [(int)$rawQuery->total_female ?? 0],
        ];
    }

    public function getMaritalStatus()
    {
        $rawQuery = Citizen::selectRaw("
            -- Single
            SUM(CASE WHEN gender = 'male' AND marital_status = 'single' THEN 1 ELSE 0 END) as male_single,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'single' THEN 1 ELSE 0 END) as female_single,
            -- Married
            SUM(CASE WHEN gender = 'male' AND marital_status = 'married' THEN 1 ELSE 0 END) as male_married,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'married' THEN 1 ELSE 0 END) as female_married,
            -- Divorced
            SUM(CASE WHEN gender = 'male' AND marital_status = 'divorced' THEN 1 ELSE 0 END) as male_divorced,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'divorced' THEN 1 ELSE 0 END) as female_divorced,
            -- Widowed
            SUM(CASE WHEN gender = 'male' AND marital_status = 'widowed' THEN 1 ELSE 0 END) as male_widowed,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'widowed' THEN 1 ELSE 0 END) as female_widowed
        ")->first();

        return [
            'male' => [
                (int)$rawQuery->male_single,
                (int)$rawQuery->male_married,
                (int)$rawQuery->male_divorced,
                (int)$rawQuery->male_widowed
            ],
            'female' => [
                (int)$rawQuery->female_single,
                (int)$rawQuery->female_married,
                (int)$rawQuery->female_divorced,
                (int)$rawQuery->female_widowed
            ],
        ];
    }

    public function getTerritory($rw = null)
    {
        $query = Territory::leftJoin('families', 'families.territory_id', '=', 'territories.id')
            ->leftJoin('citizens', function ($join) {
                $join->on('citizens.family_id', '=', 'families.id')
                    ->whereNull('citizens.deleted_at');
            })
            ->whereNull('territories.deleted_at');

        if ($rw !== null && $rw !== 'all') {
            $results = $query->where('territories.rw', trim($rw))
                ->selectRaw("
                CASE
                    WHEN TRIM(territories.rt) = '' OR territories.rt IS NULL THEN 'Tidak Diisi'
                    ELSE TRIM(territories.rt)
                END as region_name,
                COUNT(CASE WHEN citizens.gender = 'male' THEN 1 END) as male_count,
                COUNT(CASE WHEN citizens.gender = 'female' THEN 1 END) as female_count
            ")
                ->groupBy('territories.rt')
                ->orderByRaw("
                CASE WHEN TRIM(territories.rt) = '' OR territories.rt IS NULL THEN 1 ELSE 0 END,
                CAST(territories.rt AS UNSIGNED) ASC
            ")
                ->get();
        } else {
            $results = $query->selectRaw("
                CASE
                    WHEN TRIM(territories.rw) = '' OR territories.rw IS NULL THEN 'Tidak Diisi'
                    ELSE TRIM(territories.rw)
                END as region_name,
                COUNT(CASE WHEN citizens.gender = 'male' THEN 1 END) as male_count,
                COUNT(CASE WHEN citizens.gender = 'female' THEN 1 END) as female_count
            ")
                ->groupBy('territories.rw')
                ->orderByRaw("
                CASE WHEN TRIM(territories.rw) = '' OR territories.rw IS NULL THEN 1 ELSE 0 END,
                CAST(territories.rw AS UNSIGNED) ASC
            ")
                ->get();
        }

        return [
            'labels' => $results->pluck('region_name')->toArray(),
            'male'   => $results->pluck('male_count')->map('intval')->toArray(),
            'female' => $results->pluck('female_count')->map('intval')->toArray(),
        ];
    }

    public function getStatusCitizen()
    {
        $rawQuery = Citizen::selectRaw("
            SUM(CASE WHEN gender = 'male' AND family_role = 'head_of_family' THEN 1 ELSE 0 END) as male_hof,
            SUM(CASE WHEN gender = 'female' AND family_role = 'head_of_family' THEN 1 ELSE 0 END) as female_hof,

            SUM(CASE WHEN gender = 'male' AND family_role = 'spouse' THEN 1 ELSE 0 END) as male_spouse,
            SUM(CASE WHEN gender = 'female' AND family_role = 'spouse' THEN 1 ELSE 0 END) as female_spouse,

            SUM(CASE WHEN gender = 'male' AND family_role = 'child' THEN 1 ELSE 0 END) as male_child,
            SUM(CASE WHEN gender = 'female' AND family_role = 'child' THEN 1 ELSE 0 END) as female_child,

            SUM(CASE WHEN gender = 'male' AND family_role = 'parent' THEN 1 ELSE 0 END) as male_parent,
            SUM(CASE WHEN gender = 'female' AND family_role = 'parent' THEN 1 ELSE 0 END) as female_parent,

            SUM(CASE WHEN gender = 'male' AND family_role = 'other_relative' THEN 1 ELSE 0 END) as male_other,
            SUM(CASE WHEN gender = 'female' AND family_role = 'other_relative' THEN 1 ELSE 0 END) as female_other
        ")->first();

        return [
            'male' => [
                (int)$rawQuery->male_hof,
                (int)$rawQuery->male_spouse,
                (int)$rawQuery->male_child,
                (int)$rawQuery->male_parent,
                (int)$rawQuery->male_other
            ],
            'female' => [
                (int)$rawQuery->female_hof,
                (int)$rawQuery->female_spouse,
                (int)$rawQuery->female_child,
                (int)$rawQuery->female_parent,
                (int)$rawQuery->female_other
            ],
        ];
    }
}
