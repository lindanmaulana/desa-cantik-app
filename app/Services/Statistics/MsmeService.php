<?php

namespace App\Services\Statistics;

use App\Enums\MsmeType;
use Illuminate\Support\Facades\DB;
use stdClass;

class MsmeService
{
    private function baseQuery(?string $rw = null, ?string $rt = null)
    {
        $query = DB::table('msmes')
            ->join('citizens', 'msmes.citizen_id', '=', 'citizens.id')
            ->join('families', 'citizens.family_id', '=', 'families.id')
            ->join('territories', 'families.territory_id', '=', 'territories.id')
            ->whereNull('msmes.deleted_at')
            ->whereNull('citizens.deleted_at')
            ->whereNull('families.deleted_at')
            ->whereNull('territories.deleted_at');

        if ($rw) {
            $query->where('territories.rw', $rw);
        }

        if ($rt) {
            $query->where('territories.rt', $rt);
        }

        return $query;
    }

    private function compileGenderizedData(MsmeType $type, string $dbFieldOrExpression, ?string $rw = null, ?string $rt = null): array
    {
        $labels = $type->labels();
        $totalLabels = count($labels);

        $villageQuery = $this->baseQuery($rw, $rt)
            ->select([
                DB::raw("{$dbFieldOrExpression} as category_label"),
                DB::raw("SUM(CASE WHEN citizens.gender = 'male' THEN 1 ELSE 0 END) as male_count"),
                DB::raw("SUM(CASE WHEN citizens.gender = 'female' THEN 1 ELSE 0 END) as female_count"),
            ])
            ->groupBy('category_label')
            ->get();

        $male = array_fill(0, $totalLabels, 0);
        $female = array_fill(0, $totalLabels, 0);

        foreach ($villageQuery as $row) {
            $index = array_search($row->category_label, $labels);
            if ($index !== false) {
                $male[$index] = (int) $row->male_count;
                $female[$index] = (int) $row->female_count;
            }
        }

        $territoryQuery = $this->baseQuery($rw, $rt)
            ->select([
                'territories.rw',
                'territories.rt',
                DB::raw("{$dbFieldOrExpression} as category_label"),
                DB::raw("SUM(CASE WHEN citizens.gender = 'male' THEN 1 ELSE 0 END) as male_count"),
                DB::raw("SUM(CASE WHEN citizens.gender = 'female' THEN 1 ELSE 0 END) as female_count"),
            ])
            ->groupBy('territories.rw', 'territories.rt', 'category_label')
            ->orderBy('territories.rw')
            ->orderBy('territories.rt')
            ->get();

        $groupedTerritories = [];
        foreach ($territoryQuery as $row) {
            $areaKey = $row->rw . '-' . $row->rt;
            if (!isset($groupedTerritories[$areaKey])) {
                $groupedTerritories[$areaKey] = [
                    'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                    'male' => array_fill(0, $totalLabels, 0),
                    'female' => array_fill(0, $totalLabels, 0),
                ];
            }

            $index = array_search($row->category_label, $labels);
            if ($index !== false) {
                $groupedTerritories[$areaKey]['male'][$index] = (int) $row->male_count;
                $groupedTerritories[$areaKey]['female'][$index] = (int) $row->female_count;
            }
        }

        return [
            'male' => $male,
            'female' => $female,
            'by_territory' => array_values($groupedTerritories)
        ];
    }

    public function getBusinessSector(?string $rw = null, ?string $rt = null)
    {
        return $this->compileGenderizedData(MsmeType::BUSINESS_SECTOR, 'msmes.business_category', $rw, $rt);
    }

    public function getOwnerAge(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE
            WHEN TIMESTAMPDIFF(YEAR, citizens.birth_date, CURDATE()) < 30 THEN 'Gen Z & Milenial Muda (<30 Thn)'
            WHEN TIMESTAMPDIFF(YEAR, citizens.birth_date, CURDATE()) BETWEEN 30 AND 50 THEN 'Produktif Matang (30-50 Thn)'
            ELSE 'Senior / Lansia (>50 Thn)'
        END";
        return $this->compileGenderizedData(MsmeType::OWNER_AGE, $expression, $rw, $rt);
    }

    public function getOwnerEducation(?string $rw = null, ?string $rt = null)
    {
        $expression = "COALESCE((SELECT ep.education_level FROM education_profiles ep WHERE ep.citizen_id = citizens.id LIMIT 1), 'Tidak Sekolah')";
        return $this->compileGenderizedData(MsmeType::OWNER_EDUCATION, $expression, $rw, $rt);
    }

    public function getBusinessLocation(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE
        WHEN EXISTS (
                SELECT 1 FROM spatial_data sd
                WHERE sd.feature_type = 'App\\\\Models\\\\Msme'
                AND sd.feature_id = msmes.id
            ) THEN 'Sudah Terpetakan (GIS)'
            ELSE 'Belum Terpetakan'
        END";

        return $this->compileGenderizedData(MsmeType::BUSINESS_LOCATION, $expression, $rw, $rt);
    }

    public function getLegalStatus(?string $rw = null, ?string $rt = null)
    {
        return $this->compileGenderizedData(MsmeType::LEGAL_STATUS, 'msmes.legal_entity_type', $rw, $rt);
    }

    public function getNibOwnership(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE WHEN msmes.license_number IS NOT NULL AND msmes.license_number != '' THEN 'Memiliki NIB' ELSE 'Belum Memiliki NIB' END";
        return $this->compileGenderizedData(MsmeType::NIB_OWNERSHIP, $expression, $rw, $rt);
    }

    public function getMonthlyTurnover(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE
            WHEN msmes.monthly_revenue < 5000000 THEN 'Mikro (< 5 Juta)'
            WHEN msmes.monthly_revenue BETWEEN 5000000 AND 15000000 THEN 'Kecil (5 - 15 Juta)'
            ELSE 'Menengah (> 15 Juta)'
        END";
        return $this->compileGenderizedData(MsmeType::MONTHLY_TURNOVER, $expression, $rw, $rt);
    }

    public function getDigitalTransaction(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE WHEN msmes.uses_digital_payment = 1 THEN 'Menggunakan QRIS/E-Wallet' ELSE 'Tunai / Cash Only' END";
        return $this->compileGenderizedData(MsmeType::DIGITAL_TRANSACTION, $expression, $rw, $rt);
    }

    public function getDigitalPlatform(?string $rw = null, ?string $rt = null)
    {
        return $this->compileGenderizedData(MsmeType::DIGITAL_PLATFORM, 'msmes.digital_platform_type', $rw, $rt);
    }

    public function getCapitalSource(?string $rw = null, ?string $rt = null)
    {
        return $this->compileGenderizedData(MsmeType::CAPITAL_SOURCE, 'msmes.capital_source', $rw, $rt);
    }

    public function getEcoFriendly(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE WHEN msmes.is_environmentally_friendly = 1 THEN 'Ramah Lingkungan' ELSE 'Belum Standar Teknis' END";
        return $this->compileGenderizedData(MsmeType::ECO_FRIENDLY, $expression, $rw, $rt);
    }

    public function getBumdesPartnership(?string $rw = null, ?string $rt = null)
    {
        return $this->compileGenderizedData(MsmeType::BUMDES_PARTNERSHIP, 'msmes.bumdes_partnership_status', $rw, $rt);
    }

    public function getUmkmMacroStats(?string $rw = null, ?string $rt = null): stdClass
    {
        $stats = new stdClass();

        $stats->total_umkm = $this->baseQuery($rw, $rt)->count();
        $stats->total_workers = (int) $this->baseQuery($rw, $rt)->sum('msmes.employee_count');
        $stats->total_turnover = (float) $this->baseQuery($rw, $rt)->sum('msmes.monthly_revenue');
        $stats->digital_umkm = $this->baseQuery($rw, $rt)->where('msmes.uses_digital_payment', 1)->count();

        return $stats;
    }
}
