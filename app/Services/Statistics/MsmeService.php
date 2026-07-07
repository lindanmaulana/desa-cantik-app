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
        $expression = "CASE
            WHEN msmes.business_category = 'culinary' THEN 'Kuliner'
            WHEN msmes.business_category = 'fashion' THEN 'Fashion'
            WHEN msmes.business_category = 'agriculture' THEN 'Pertanian'
            WHEN msmes.business_category = 'services' THEN 'Jasa'
            WHEN msmes.business_category = 'craft' THEN 'Kerajinan'
            WHEN msmes.business_category = 'trade' THEN 'Perdagangan'
            ELSE 'Lainnya'
        END";

        return $this->compileGenderizedData(MsmeType::BUSINESS_SECTOR, $expression, $rw, $rt);
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
        $expression = "COALESCE(
        (
            SELECT CASE
                WHEN ep.education_level = 'none' THEN 'Tidak Sekolah'
                WHEN ep.education_level = 'elementory_school' THEN 'SD / Sederajat'
                WHEN ep.education_level = 'middle_school' THEN 'SMP / Sederajat'
                WHEN ep.education_level = 'high_school' THEN 'SMA / Sederajat'
                WHEN ep.education_level = 'associate_degree' THEN 'Diploma (D1-D4)'
                WHEN ep.education_level = 'bachelor_degree' THEN 'Sarjana (S1)'
                WHEN ep.education_level = 'postgraduate' THEN 'Pascasarjana (S2/S3)'
                ELSE 'Tidak Sekolah'
            END
            FROM education_profiles ep
            WHERE ep.citizen_id = citizens.id
            LIMIT 1
        ),
        'Tidak Sekolah'
    )";

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
        $expression = "CASE
    WHEN msmes.legal_entity_type = 'unregistered' THEN 'Belum Terdaftar'
    WHEN msmes.legal_entity_type = 'sole_proprietorship' THEN 'Perusahaan Perseorangan (PO)'
    WHEN msmes.legal_entity_type = 'limited_partnership' THEN 'Persekutuan Komanditer (CV)'
    WHEN msmes.legal_entity_type = 'limited_company' THEN 'Perseroan Terbatas (PT)'
    WHEN msmes.legal_entity_type = 'cooperative' THEN 'Koperasi'
    ELSE 'Belum Terdaftar'
END";

        return $this->compileGenderizedData(MsmeType::LEGAL_STATUS, $expression, $rw, $rt);
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
        $expression = "CASE
    WHEN msmes.digital_platform_type = 'none' THEN 'Tidak Menggunakan'
    WHEN msmes.digital_platform_type = 'social_media' THEN 'Media Sosial'
    WHEN msmes.digital_platform_type = 'ecommerce' THEN 'E-commerce'
    WHEN msmes.digital_platform_type = 'delivery_app' THEN 'Aplikasi Pengantaran (Delivery)'
    WHEN msmes.digital_platform_type = 'ride_hailing' THEN 'Ojek Online / Transportasi'
    ELSE 'Tidak Menggunakan'
    END";

        return $this->compileGenderizedData(MsmeType::DIGITAL_PLATFORM, $expression, $rw, $rt);
    }

    public function getCapitalSource(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE
    WHEN msmes.capital_source = 'personal' THEN 'Modal Sendiri / Pribadi'
    WHEN msmes.capital_source = 'bank_loan' THEN 'Pinjaman Bank'
    WHEN msmes.capital_source = 'goverment_credit' THEN 'Kredit Program Pemerintah'
    WHEN msmes.capital_source = 'goverment_grant' THEN 'Bantuan / Hibah Pemerintah'
    WHEN msmes.capital_source = 'family_relative' THEN 'Pinjaman Keluarga / Kerabat'
    ELSE 'Modal Sendiri / Pribadi'
END";

        return $this->compileGenderizedData(MsmeType::CAPITAL_SOURCE, $expression, $rw, $rt);
    }

    public function getEcoFriendly(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE WHEN msmes.is_environmentally_friendly = 1 THEN 'Ramah Lingkungan' ELSE 'Belum Standar Teknis' END";
        return $this->compileGenderizedData(MsmeType::ECO_FRIENDLY, $expression, $rw, $rt);
    }

    public function getBumdesPartnership(?string $rw = null, ?string $rt = null)
    {
        $expression = "CASE
    WHEN msmes.bumdes_partnership_status = 'none' THEN 'Tidak Ada Kemitraan'
    WHEN msmes.bumdes_partnership_status = 'consigment_product' THEN 'Titip Jual Produk (Konsinyasi)'
    WHEN msmes.bumdes_partnership_status = 'raw_material_supply' THEN 'Pasokan Bahan Baku'
    WHEN msmes.bumdes_partnership_status = 'capital_invesment' THEN 'Penyertaan Modal'
    WHEN msmes.bumdes_partnership_status = 'marketing_cooperation' THEN 'Kerjasama Pemasaran'
    ELSE 'Tidak Ada Kemitraan'
END";

        return $this->compileGenderizedData(MsmeType::BUMDES_PARTNERSHIP, $expression, $rw, $rt);
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
