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
            ->leftJoin("territories", "families.territory_id", "=", "territories.id");

        if ($rw) {
            $query->where(fn($q) => $q->where('territories.rw', $rw)->orWhere('territories.rw', (int)$rw));
        }
        if ($rt) {
            $query->where(fn($q) => $q->where('territories.rt', $rt)->orWhere('territories.rt', (int)$rt));
        }

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, '000') as rw,
            COALESCE(territories.rt, '000') as rt,
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
            SUM(CASE WHEN gender = 'female' AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 65 THEN 1 ELSE 0 END) as female_seniors,
            SUM(CASE WHEN (gender = 'male' OR gender NOT IN ('male', 'female') OR gender IS NULL) AND (birth_date IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 0) THEN 1 ELSE 0 END) as male_unmapped,
            SUM(CASE WHEN gender = 'female' AND (birth_date IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) IS NULL OR TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 0) THEN 1 ELSE 0 END) as female_unmapped
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
                    'label' => "RW " . $row->rw . " / RT " . $row->rt,
                    'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
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

    public function getGender(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query();

        $query->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id");

        if ($rw) {
            $query->where(fn($q) => $q->where('territories.rw', $rw)->orWhere('territories.rw', (int)$rw));
        }
        if ($rt) {
            $query->where(fn($q) => $q->where('territories.rt', $rt)->orWhere('territories.rt', (int)$rt));
        }

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, '000') as rw,
            COALESCE(territories.rt, '000') as rt,
            SUM(CASE WHEN gender = 'male'  THEN 1 ELSE 0 END) as total_male,
            SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) as total_female
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')
            ->orderBy('territories.rt')
            ->get();

        return [
            'male' => [(int)$rawQuery->sum('total_male')],
            'female' => [(int)$rawQuery->sum('total_female')],
            'by_territory' => $rawQuery->map(function ($row) {
                return [
                    'label' => "RW " . $row->rw . " / RT " . $row->rt,
                    'territory' => ['rw' => $row->rw, 'rt' => $row->rt],

                    'male' => [
                        (int)($row->total_male ?? 0),
                        0
                    ],
                    'female' => [
                        0,
                        (int)($row->total_female ?? 0)
                    ],
                ];
            })->all(),
            'raw' => $rawQuery
        ];
    }

    public function getMaritalStatus(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query();

        $query->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id");

        if ($rw) {
            $query->where(fn($q) => $q->where('territories.rw', $rw)->orWhere('territories.rw', (int)$rw));
        }
        if ($rt) {
            $query->where(fn($q) => $q->where('territories.rt', $rt)->orWhere('territories.rt', (int)$rt));
        }

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, '000') as rw,
            COALESCE(territories.rt, '000') as rt,
            SUM(CASE WHEN gender = 'male' AND marital_status = 'single' THEN 1 ELSE 0 END) as male_single,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'single' THEN 1 ELSE 0 END) as female_single,
            SUM(CASE WHEN gender = 'male' AND marital_status = 'married' THEN 1 ELSE 0 END) as male_married,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'married' THEN 1 ELSE 0 END) as female_married,
            SUM(CASE WHEN gender = 'male' AND marital_status = 'divorced' THEN 1 ELSE 0 END) as male_divorced,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'divorced' THEN 1 ELSE 0 END) as female_divorced,
            SUM(CASE WHEN gender = 'male' AND marital_status = 'widowed' THEN 1 ELSE 0 END) as male_widowed,
            SUM(CASE WHEN gender = 'female' AND marital_status = 'widowed' THEN 1 ELSE 0 END) as female_widowed
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')
            ->orderBy('territories.rt')
            ->get();

        return [
            'male' => [
                (int) $rawQuery->sum('male_single'),
                (int) $rawQuery->sum('male_married'),
                (int) $rawQuery->sum('male_divorced'),
                (int) $rawQuery->sum('male_widowed')
            ],
            'female' => [
                (int) $rawQuery->sum('female_single'),
                (int) $rawQuery->sum('female_married'),
                (int) $rawQuery->sum('female_divorced'),
                (int) $rawQuery->sum('female_widowed')
            ],
            'by_territory' => $rawQuery->map(function ($row) {
                return [
                    'label' => "RW " . $row->rw . " / RT " . $row->rt,
                    'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                    'male' => [
                        (int) ($row->male_single ?? 0),
                        (int) ($row->male_married ?? 0),
                        (int) ($row->male_divorced ?? 0),
                        (int) ($row->male_widowed ?? 0),
                    ],
                    'female' => [
                        (int) ($row->female_single ?? 0),
                        (int) ($row->female_married ?? 0),
                        (int) ($row->female_divorced ?? 0),
                        (int) ($row->female_widowed ?? 0),
                    ],
                ];
            })->all(),
            'raw' => $rawQuery
        ];
    }

    public function getTerritory($rw = null, $rt = null)
    {
        $query = Territory::leftJoin('families', 'families.territory_id', '=', 'territories.id')
            ->leftJoin('citizens', function ($join) {
                $join->on('citizens.family_id', '=', 'families.id')
                    ->whereNull('citizens.deleted_at');
            })
            ->whereNull('territories.deleted_at');

        $isRwFiltered = ($rw !== null && $rw !== 'all');
        $isRtFiltered = ($rt !== null && $rt !== 'all');

        if ($isRwFiltered) {
            $query->where(fn($q) => $q->where('territories.rw', trim($rw))->orWhere('territories.rw', (int)$rw));
        }

        if ($isRtFiltered) {
            $query->where(fn($q) => $q->where('territories.rt', trim($rt))->orWhere('territories.rt', (int)$rt));
        }

        if ($isRwFiltered) {
            $query->selectRaw("
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
        ");
        } else {
            $query->selectRaw("
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
        ");
        }

        $results = $query->get();

        $byTerritory = $results->map(function ($row) use ($rw, $isRwFiltered, $isRtFiltered) {
            return [
                'territory' => [
                    'rw' => $isRwFiltered ? trim($rw) : $row->region_name,
                    'rt' => $isRtFiltered ? trim($row->region_name) : ($isRwFiltered ? $row->region_name : '-'),
                ],
                'male'   => [(int) $row->male_count],
                'female' => [(int) $row->female_count],
            ];
        })->all();

        return [
            'labels'       => $results->pluck('region_name')->toArray(),
            'male'         => $results->pluck('male_count')->map('intval')->toArray(),
            'female'       => $results->pluck('female_count')->map('intval')->toArray(),
            'by_territory' => $byTerritory,
        ];
    }

    public function getStatusCitizen(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query();

        $query->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id");

        if ($rw) {
            $query->where(fn($q) => $q->where('territories.rw', $rw)->orWhere('territories.rw', (int)$rw));
        }
        if ($rt) {
            $query->where(fn($q) => $q->where('territories.rt', $rt)->orWhere('territories.rt', (int)$rt));
        }

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, '000') as rw,
            COALESCE(territories.rt, '000') as rt,
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
        ")
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')
            ->orderBy('territories.rt')
            ->get();

        return [
            'male' => [
                (int) $rawQuery->sum('male_hof'),
                (int) $rawQuery->sum('male_spouse'),
                (int) $rawQuery->sum('male_child'),
                (int) $rawQuery->sum('male_parent'),
                (int) $rawQuery->sum('male_other')
            ],
            'female' => [
                (int) $rawQuery->sum('female_hof'),
                (int) $rawQuery->sum('female_spouse'),
                (int) $rawQuery->sum('female_child'),
                (int) $rawQuery->sum('female_parent'),
                (int) $rawQuery->sum('female_other')
            ],
            'by_territory' => $rawQuery->map(function ($row) {
                return [
                    'label' => "RW " . $row->rw . " / RT " . $row->rt,
                    'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                    'male' => [
                        (int) ($row->male_hof ?? 0),
                        (int) ($row->male_spouse ?? 0),
                        (int) ($row->male_child ?? 0),
                        (int) ($row->male_parent ?? 0),
                        (int) ($row->male_other ?? 0),
                    ],
                    'female' => [
                        (int) ($row->female_hof ?? 0),
                        (int) ($row->female_spouse ?? 0),
                        (int) ($row->female_child ?? 0),
                        (int) ($row->female_parent ?? 0),
                        (int) ($row->female_other ?? 0),
                    ],
                ];
            })->all(),
            'raw' => $rawQuery
        ];
    }
}
