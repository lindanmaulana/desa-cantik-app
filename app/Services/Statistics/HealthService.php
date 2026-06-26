<?php

namespace App\Services\Statistics;

use App\Enums\HealthType;
use App\Models\Citizen;
use Illuminate\Support\Facades\DB;

class HealthService
{
    /**
     * Helper subquery untuk mengambil log pertumbuhan balita paling terupdate/terakhir
     */
    private function getLatestChildGrowthLogQuery()
    {
        return DB::table('child_growth_logs as cgl1')
            ->select('cgl1.citizen_id', 'cgl1.stunting_status')
            ->join(DB::raw('(SELECT citizen_id, MAX(measured_at) as max_measured_at FROM child_growth_logs GROUP BY citizen_id) as cgl2'), function ($join) {
                $join->on('cgl1.citizen_id', '=', 'cgl2.citizen_id')
                    ->on('cgl1.measured_at', '=', 'cgl2.max_measured_at');
            });
    }

    public function getHealthStats()
    {
        return Citizen::query()
            ->leftJoin('health_profiles', 'citizens.id', '=', 'health_profiles.citizen_id')
            ->leftJoinSub($this->getLatestChildGrowthLogQuery(), 'latest_logs', function ($join) {
                $join->on('citizens.id', '=', 'latest_logs.citizen_id');
            })
            ->selectRaw("
                -- 1. Total warga penyandang disabilitas
                SUM(CASE WHEN health_profiles.disability_type IS NOT NULL AND health_profiles.disability_type != 'none' THEN 1 ELSE 0 END) as total_disabilities,

                -- 2. Warga dengan golongan darah terdata resmi
                SUM(CASE WHEN citizens.blood_type IS NOT NULL AND citizens.blood_type NOT IN ('-', 'unknown') THEN 1 ELSE 0 END) as total_blood_registered,

                -- 3. Jumlah Balita Terindikasi Stunting (Mengambil dari log terbaru)
                SUM(CASE WHEN TIMESTAMPDIFF(MONTH, citizens.birth_date, NOW()) <= 60 AND latest_logs.stunting_status IN ('severely_stunted', 'stunted') THEN 1 ELSE 0 END) as total_stunting_cases,

                -- 4. Jumlah Ibu Hamil Aktif Saat Ini
                SUM(CASE WHEN citizens.gender = 'female' AND health_profiles.is_pregnant = 1 THEN 1 ELSE 0 END) as total_active_pregnancy
            ")
            ->whereNull('citizens.deleted_at')
            ->first();
    }

    /**
     * 1. STATUS STUNTING BALITA (Usia 0-5 Tahun)
     */
    public function getStuntingStatus(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoinSub($this->getLatestChildGrowthLogQuery(), 'latest_logs', function ($join) {
                $join->on('citizens.id', '=', 'latest_logs.citizen_id');
            })
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN latest_logs.stunting_status = 'severely_stunted' THEN 1 ELSE 0 END) as severely_stunted,
            SUM(CASE WHEN latest_logs.stunting_status = 'stunted' THEN 1 ELSE 0 END) as stunted,
            SUM(CASE WHEN latest_logs.stunting_status = 'normal' OR latest_logs.stunting_status IS NULL THEN 1 ELSE 0 END) as normal
        ")
            ->whereRaw("TIMESTAMPDIFF(MONTH, citizens.birth_date, NOW()) <= 60") // Filter khusus Balita (<= 5 Tahun)
            ->whereNull('citizens.deleted_at')
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => HealthType::STUNTING_STATUS->labels(),
            'datasets' => [
                (int) $rawQuery->sum('severely_stunted'),
                (int) $rawQuery->sum('stunted'),
                (int) $rawQuery->sum('normal'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->severely_stunted ?? 0),
                    (int) ($row->stunted ?? 0),
                    (int) ($row->normal ?? 0),
                ]
            ])->all()
        ];
    }

    /**
     * 2. STATUS GIZI BALITA
     * Catatan: Skema database tidak menyediakan kolom nutritional_status secara eksplisit.
     * Logika ini disesuaikan untuk mengembalikan nilai kosong atau mengacu pada pemetaan dasar normal balita non-stunting.
     */
    public function getNutritionalStatus(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoinSub($this->getLatestChildGrowthLogQuery(), 'latest_logs', function ($join) {
                $join->on('citizens.id', '=', 'latest_logs.citizen_id');
            })
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            0 as severely_wasted,
            0 as wasted,
            SUM(CASE WHEN latest_logs.stunting_status IS NOT NULL THEN 1 ELSE 0 END) as normal,
            0 as overweight
        ")
            ->whereRaw("TIMESTAMPDIFF(MONTH, citizens.birth_date, NOW()) <= 60")
            ->whereNull('citizens.deleted_at')
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => HealthType::NUTRITIONAL_STATUS->labels(),
            'datasets' => [
                (int) $rawQuery->sum('severely_wasted'),
                (int) $rawQuery->sum('wasted'),
                (int) $rawQuery->sum('normal'),
                (int) $rawQuery->sum('overweight'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->severely_wasted ?? 0),
                    (int) ($row->wasted ?? 0),
                    (int) ($row->normal ?? 0),
                    (int) ($row->overweight ?? 0),
                ]
            ])->all()
        ];
    }

    /**
     * 3. STATUS KEHAMILAN (Pregnancy Status)
     */
    public function getPregnancyStatus(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("health_profiles", "citizens.id", "=", "health_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN citizens.gender = 'female' AND health_profiles.is_pregnant = 1 AND (TIMESTAMPDIFF(YEAR, citizens.birth_date, NOW()) BETWEEN 20 AND 35) THEN 1 ELSE 0 END) as active_pregnant,
            SUM(CASE WHEN citizens.gender = 'female' AND health_profiles.is_pregnant = 1 AND (TIMESTAMPDIFF(YEAR, citizens.birth_date, NOW()) < 20 OR TIMESTAMPDIFF(YEAR, citizens.birth_date, NOW()) > 35) THEN 1 ELSE 0 END) as risky_pregnant
        ")
            ->whereNull('citizens.deleted_at')
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => HealthType::PREGNANCY->labels(),
            'datasets' => [
                (int) $rawQuery->sum('active_pregnant'),
                (int) $rawQuery->sum('risky_pregnant'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->active_pregnant ?? 0),
                    (int) ($row->risky_pregnant ?? 0),
                ]
            ])->all()
        ];
    }

    /**
     * 4. KELUARGA BERENCANA (Family Planning)
     */
    public function getFamilyPlanning(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("health_profiles", "citizens.id", "=", "health_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN health_profiles.kb_method = 'injection' THEN 1 ELSE 0 END) as injection,
            SUM(CASE WHEN health_profiles.kb_method = 'pill' THEN 1 ELSE 0 END) as pill,
            SUM(CASE WHEN health_profiles.kb_method = 'condom' THEN 1 ELSE 0 END) as condom,
            SUM(CASE WHEN health_profiles.kb_method = 'implant' THEN 1 ELSE 0 END) as implant,
            SUM(CASE WHEN health_profiles.kb_method = 'iud' THEN 1 ELSE 0 END) as iud,
            SUM(CASE WHEN health_profiles.kb_method = 'tubal_ligation' THEN 1 ELSE 0 END) as mow, -- Menyesuaikan DB ENUM 'tubal_ligation'
            SUM(CASE WHEN health_profiles.kb_method = 'vasectomy' THEN 1 ELSE 0 END) as mop
        ")
            ->whereNull('citizens.deleted_at')
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => HealthType::FAMILY_PLANNING->labels(),
            'datasets' => [
                (int) $rawQuery->sum('injection'),
                (int) $rawQuery->sum('pill'),
                (int) $rawQuery->sum('condom'),
                (int) $rawQuery->sum('implant'),
                (int) $rawQuery->sum('iud'),
                (int) $rawQuery->sum('mow'),
                (int) $rawQuery->sum('mop'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->injection ?? 0),
                    (int) ($row->pill ?? 0),
                    (int) ($row->condom ?? 0),
                    (int) ($row->implant ?? 0),
                    (int) ($row->iud ?? 0),
                    (int) ($row->mow ?? 0),
                    (int) ($row->mop ?? 0),
                ]
            ])->all()
        ];
    }

    /**
     * 5. JAMINAN KESEHATAN (BPJS Kesehatan Status)
     */
    public function getBpjsStatus(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("health_profiles", "citizens.id", "=", "health_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN health_profiles.bpjs_status = 'none' OR health_profiles.bpjs_status IS NULL THEN 1 ELSE 0 END) as no_insurance,
            SUM(CASE WHEN health_profiles.bpjs_status = 'goverment_subsidized' THEN 1 ELSE 0 END) as pbi_member,
            SUM(CASE WHEN health_profiles.bpjs_status = 'independent_member' THEN 1 ELSE 0 END) as independent_member,
            SUM(CASE WHEN health_profiles.bpjs_status = 'company_member' THEN 1 ELSE 0 END) as company_member
        ")
            ->whereNull('citizens.deleted_at')
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => HealthType::BPJS_STATUS->labels(),
            'datasets' => [
                (int) $rawQuery->sum('no_insurance'),
                (int) $rawQuery->sum('pbi_member'),
                (int) $rawQuery->sum('independent_member'),
                (int) $rawQuery->sum('company_member'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->no_insurance ?? 0),
                    (int) ($row->pbi_member ?? 0),
                    (int) ($row->independent_member ?? 0),
                    (int) ($row->company_member ?? 0),
                ]
            ])->all()
        ];
    }

    /**
     * 6. GOLONGAN DARAH (Blood Type)
     */
    public function getBloodType(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN blood_type = 'A' THEN 1 ELSE 0 END) as type_a,
            SUM(CASE WHEN blood_type = 'B' THEN 1 ELSE 0 END) as type_b,
            SUM(CASE WHEN blood_type = 'AB' THEN 1 ELSE 0 END) as type_ab,
            SUM(CASE WHEN blood_type = 'O' THEN 1 ELSE 0 END) as type_o,
            SUM(CASE WHEN blood_type = 'A+' THEN 1 ELSE 0 END) as type_a_plus,
            SUM(CASE WHEN blood_type = 'A-' THEN 1 ELSE 0 END) as type_a_minus,
            SUM(CASE WHEN blood_type = 'B+' THEN 1 ELSE 0 END) as type_b_plus,
            SUM(CASE WHEN blood_type = 'B-' THEN 1 ELSE 0 END) as type_b_minus,
            SUM(CASE WHEN blood_type = 'AB+' THEN 1 ELSE 0 END) as type_ab_plus,
            SUM(CASE WHEN blood_type = 'AB-' THEN 1 ELSE 0 END) as type_ab_minus,
            SUM(CASE WHEN blood_type = 'O+' THEN 1 ELSE 0 END) as type_o_plus,
            SUM(CASE WHEN blood_type = 'O-' THEN 1 ELSE 0 END) as type_o_minus,
            SUM(CASE WHEN blood_type = 'unknown' OR blood_type IS NULL OR blood_type = '-' THEN 1 ELSE 0 END) as unknown
        ")
            ->whereNull('citizens.deleted_at')
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => HealthType::BLOOD_TYPE->labels(),
            'datasets' => [
                (int) $rawQuery->sum('type_a'),
                (int) $rawQuery->sum('type_b'),
                (int) $rawQuery->sum('type_ab'),
                (int) $rawQuery->sum('type_o'),
                (int) $rawQuery->sum('type_a_plus'),
                (int) $rawQuery->sum('type_a_minus'),
                (int) $rawQuery->sum('type_b_plus'),
                (int) $rawQuery->sum('type_b_minus'),
                (int) $rawQuery->sum('type_ab_plus'),
                (int) $rawQuery->sum('type_ab_minus'),
                (int) $rawQuery->sum('type_o_plus'),
                (int) $rawQuery->sum('type_o_minus'),
                (int) $rawQuery->sum('unknown')
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int)$row->type_a,
                    (int)$row->type_b,
                    (int)$row->type_ab,
                    (int)$row->type_o,
                    (int)$row->type_a_plus,
                    (int)$row->type_a_minus,
                    (int)$row->type_b_plus,
                    (int)$row->type_b_minus,
                    (int)$row->type_ab_plus,
                    (int)$row->type_ab_minus,
                    (int)$row->type_o_plus,
                    (int)$row->type_o_minus,
                    (int)$row->unknown
                ]
            ])->all()
        ];
    }

    /**
     * 7. DISABILITAS (Disability)
     */
    public function getDisability(?string $rw = null, ?string $rt = null)
    {
        $query = Citizen::query()
            ->leftJoin("health_profiles", "citizens.id", "=", "health_profiles.citizen_id")
            ->leftJoin("families", "citizens.family_id", "=", "families.id")
            ->leftJoin("territories", "families.territory_id", "=", "territories.id")
            ->when($rw, fn($q) => $q->where('territories.rw', $rw))
            ->when($rt, fn($q) => $q->where('territories.rt', $rt));

        $rawQuery = $query->selectRaw("
            COALESCE(territories.rw, 'Tanpa RW') as rw,
            COALESCE(territories.rt, 'Tanpa RT') as rt,
            SUM(CASE WHEN health_profiles.disability_type = 'physical' THEN 1 ELSE 0 END) as physical,
            SUM(CASE WHEN health_profiles.disability_type = 'intellectual' THEN 1 ELSE 0 END) as intellectual,
            SUM(CASE WHEN health_profiles.disability_type = 'mental' THEN 1 ELSE 0 END) as mental,
            SUM(CASE WHEN health_profiles.disability_type = 'sensory' THEN 1 ELSE 0 END) as sensory
        ")
            ->where('health_profiles.disability_type', '!=', 'none')
            ->whereNull('citizens.deleted_at')
            ->groupBy('territories.rw', 'territories.rt')
            ->orderBy('territories.rw')->orderBy('territories.rt')->get();

        return [
            'labels' => HealthType::DISABILITY->labels(),
            'datasets' => [
                (int) $rawQuery->sum('physical'),
                (int) $rawQuery->sum('intellectual'),
                (int) $rawQuery->sum('mental'),
                (int) $rawQuery->sum('sensory'),
            ],
            'by_territory' => $rawQuery->map(fn($row) => [
                'label' => ($row->rw === 'Tanpa RW') ? 'Tanpa Wilayah KK' : "RW {$row->rw} / RT {$row->rt}",
                'territory' => ['rw' => $row->rw, 'rt' => $row->rt],
                'datasets' => [
                    (int) ($row->physical ?? 0),
                    (int) ($row->intellectual ?? 0),
                    (int) ($row->mental ?? 0),
                    (int) ($row->sensory ?? 0),
                ]
            ])->all()
        ];
    }
}
