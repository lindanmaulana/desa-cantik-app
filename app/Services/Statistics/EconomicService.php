<?php

namespace App\Services\Statistics;

use App\Enums\EconomicType;
use App\Models\Citizen;
use App\Models\Family;

class EconomicService
{
    /**
     * Mengambil data statistik ringkas untuk kartu dashboard ekonomi
     */
    public function getEconomicStats()
    {
        return Citizen::query()
            ->leftJoin('employment_profiles', 'citizens.id', '=', 'employment_profiles.citizen_id')
            ->selectRaw("
            SUM(CASE WHEN employment_profiles.employment_status IN ('employee', 'self_employed', 'casual_worker') THEN 1 ELSE 0 END) as total_employed,
            SUM(CASE WHEN employment_profiles.employment_status = 'unpaid_worker' THEN 1 ELSE 0 END) as total_unemployed,
            (SELECT COUNT(*)
             FROM families
             JOIN housing_profiles ON families.id = housing_profiles.family_id
             WHERE housing_profiles.house_ownership = 'owned'
            ) as total_self_owned_houses,
            SUM(CASE WHEN employment_profiles.is_welfare_recipient = 1 THEN 1 ELSE 0 END) as total_welfare_recipients
        ")->first();
    }

    /**
     * Helper privat untuk mengeksekusi query ekonomi dengan struktur standar male & female
     */
    private function queryEconomicData(string $column, array $categories, ?string $rw = null, ?string $rt = null, string $tableAlias = 'employment_profiles')
    {
        $query = Citizen::query();

        // 💡 SOLUSI: Hanya join ke tabel profil yang dibutuhkan saja untuk menghindari duplikasi data (overcounting)
        if ($tableAlias === 'housing_profiles') {
            $query->leftJoin("housing_profiles", "citizens.family_id", "=", "housing_profiles.family_id");
        } else {
            $query->leftJoin("employment_profiles", "citizens.id", "=", "employment_profiles.citizen_id");
        }

        // Hubungkan ke wilayah
        $query->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $selectStatements = [
            "COALESCE(territories.rw, 'Tanpa RW') as rw",
            "COALESCE(territories.rt, 'Tanpa RT') as rt"
        ];

        foreach ($categories as $key => $value) {
            $selectStatements[] = "SUM(CASE WHEN citizens.gender = 'male' AND {$tableAlias}.{$column} = '{$key}' THEN 1 ELSE 0 END) as `male_{$key}`";
            $selectStatements[] = "SUM(CASE WHEN citizens.gender = 'female' AND {$tableAlias}.{$column} = '{$key}' THEN 1 ELSE 0 END) as `female_{$key}`";
        }

        $rawQuery = $query->selectRaw(implode(", ", $selectStatements))
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')
            ->orderBy('territories.rt')
            ->get();

        $maleVillage = [];
        $femaleVillage = [];
        foreach ($categories as $key => $value) {
            $maleVillage[] = (int) $rawQuery->sum("male_{$key}");
            $femaleVillage[] = (int) $rawQuery->sum("female_{$key}");
        }

        return [
            'male' => $maleVillage,
            'female' => $femaleVillage,
            'by_territory' => $rawQuery->map(function ($row) use ($categories) {
                $maleTerritory = [];
                $femaleTerritory = [];

                foreach ($categories as $key => $value) {
                    $maleTerritory[] = (int) ($row->{"male_{$key}"} ?? 0);
                    $femaleTerritory[] = (int) ($row->{"female_{$key}"} ?? 0);
                }

                return [
                    'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah' : "RW {$row->rw} / RT {$row->rt}",
                    'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                    'male' => $maleTerritory,
                    'female' => $femaleTerritory,
                ];
            })->all()
        ];
    }

    public function getOccupation(?string $rw = null, ?string $rt = null)
    {
        $topOccupations = Citizen::query()
            ->leftJoin('employment_profiles', 'citizens.id', '=', 'employment_profiles.citizen_id')
            ->whereNull('citizens.deleted_at')
            ->whereNotNull('employment_profiles.occupation')
            ->where('employment_profiles.occupation', '!=', '')
            ->groupBy('employment_profiles.occupation')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->pluck('employment_profiles.occupation')
            ->all();

        $categories = [];
        foreach ($topOccupations as $job) {
            $categories[$job] = ucwords(strtolower($job));
        }

        if (empty($categories)) {
            $categories = ['none' => 'Tidak Ada Data'];
        }

        $result = $this->queryEconomicData('occupation', $categories, $rw, $rt, 'employment_profiles');

        $result['dynamic_labels'] = array_values($categories);

        return $result;
    }

    /**
     * 2. SEKTOR PEKERJAAN (Job Sector)
     */
    public function getJobSector(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::JOB_SECTOR->options();

        return $this->queryEconomicData('job_sector', $categories, $rw, $rt);
    }

    /**
     * 3. STATUS PEKERJAAN (Employment Status)
     */
    public function getEmploymentStatus(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::EMPLOYMENT_STATUS->options();

        return $this->queryEconomicData('employment_status', $categories, $rw, $rt);
    }

    /**
     * 4. STATUS KEPEMILIKAN RUMAH (House Ownership)
     */
    public function getHouseOwnership(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::HOUSE_OWNERSHIP->options();

        return $this->queryEconomicData('house_ownership', $categories, $rw, $rt, 'housing_profiles');
    }

    /**
     * 5. BAHAN LANTAI (Floor Material)
     */
    public function getFloorMaterial(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::FLOOR_MATERIAL->options();

        return $this->queryEconomicData('floor_material', $categories, $rw, $rt, 'housing_profiles');
    }

    /**
     * 6. BAHAN DINDING (Wall Material)
     */
    public function getWallMaterial(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::WALL_MATERIAL->options();

        return $this->queryEconomicData('wall_material', $categories, $rw, $rt, 'housing_profiles');
    }

    /**
     * 7. BAHAN ATAP (Roof Material)
     */
    public function getRoofMaterial(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::ROOF_MATERIAL->options();

        return $this->queryEconomicData('roof_material', $categories, $rw, $rt, 'housing_profiles');
    }

    /**
     * 8. BAHAN BAKAR MEMASAK (Cooking Fuel)
     */
    public function getCookingFuel(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::COOKING_FUEL->options();

        return $this->queryEconomicData('cooking_fuel', $categories, $rw, $rt, 'housing_profiles');
    }

    /**
     * 9. KAPASITAS LISTRIK (Electricity Capacity)
     */
    public function getElectricityCapacity(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::ELECTRICITY_CAPACITY->options();

        return $this->queryEconomicData('electricity_capacity', $categories, $rw, $rt, 'housing_profiles');
    }

    public function getElectricitySource(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::ELECTRICITY_SOURCE->options();

        return $this->queryEconomicData(EconomicType::ELECTRICITY_SOURCE->value, $categories, $rw, $rt, 'housing_profiles');
    }

    /**
     * 10. STATUS EKONOMI (Economic Status)
     */
    public function getEconomicStatus(?string $rw = null, ?string $rt = null)
    {
        $categories = EconomicType::ECONOMIC_STATUS->options();

        return $this->queryEconomicData('economic_status', $categories, $rw, $rt);
    }
}
