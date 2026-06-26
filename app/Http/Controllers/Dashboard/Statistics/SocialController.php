<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\SocialType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\SocialRequest;
use App\Services\ManageData\TerritoriesService;
use App\Services\Statistics\SocialService;

class SocialController extends Controller
{
    public function __construct(
        protected SocialService $socialService,
        protected TerritoriesService $territoriesService
    ) {}

    public function index(SocialRequest $request)
    {
        $validated = $request->validated();
        $rwFilter = !empty($validated['rw']) && $validated['rw'] !== 'all' ? $validated['rw'] : null;
        $rtFilter = !empty($validated['rt']) && $validated['rt'] !== 'all' ? $validated['rt'] : null;

        $stats = $this->socialService->getSocialStats();

        $currentType = SocialType::tryFrom($validated['type'] ?? SocialType::RELIGION->value) ?? SocialType::RELIGION;

        $data = match ($currentType) {
            SocialType::RELIGION     => $this->socialService->getReligion($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::SCHOOL_PARTICIPATION => $this->socialService->getSchoolParticipation($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::EDUCATION_LEVEL => $this->socialService->getEducationLevel($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::HIGHEST_DIPLOMA => $this->socialService->getHighestDiploma($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::BLOOD_TYPE   => $this->socialService->getBloodType($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::DISABILITY   => $this->socialService->getDisability($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::PREGNANCY   => $this->socialService->getPregnancyStatus($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::FAMILY_PLANNING   => $this->socialService->getFamilyPlanning($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::BPJS_STATUS   => $this->socialService->getBpjsStatus($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::WELFARE_ASSISTANCE   => $this->socialService->getSocialAssistanceStatus($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::SANITATION   => $this->socialService->getSanitation($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::WATER_SOURCE   => $this->socialService->getWaterSource($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::ELECTRICITY_SOURCE   => $this->socialService->getElectricitySource($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::ELECTRICITY_CAPACITY   => $this->socialService->getElectricityCapacity($validated["rw"] ?? null, $validated["rt"] ?? null),
        };

        $formatted = $this->formatThematicData($currentType, $data);

        $rwList = $this->territoriesService->getUniqueRwOptions();
        $rtList = $this->territoriesService->getRtOptionsByRw($rwFilter);

        return view('dashboard.statistics.social.index', compact('stats'))->with([
            'currentType'                  => $currentType,
            'chartType'                    => $currentType->chartType(),
            'chartLabels'                  => $formatted['chartLabels'],
            'chartData'                    => $formatted['chartData'],
            'data'                         => $data,
            'tableAggregateVillageData'    => $formatted['tableAggregateVillageData'],
            'tableAggregateTerritoryData'  => $formatted['tableAggregateTerritoryData'],
            'rwList'                      => $rwList,
            'rtList'                      => $rtList,
        ]);
    }

    /**
     * Memformat data tematik murni (Tanpa split gender kaku)
     */
    public function formatThematicData(SocialType $type, array $data): array
    {
        $chartLabels = $data['labels'] ?? [];
        $datasets    = $data['datasets'] ?? [];
        $grandTotal  = array_sum($datasets);

        // Transformasi untuk Tabel 1: Agregat Level Desa
        $tableAggregateVillageData = $this->resolveTableVillageData($chartLabels, $datasets, $grandTotal);

        // Transformasi untuk Tabel 2: Agregat Level Teritorial (RW/RT)
        $tableAggregateTerritoryData = $this->resolveTableTerritoryData($chartLabels, $data);

        return [
            'chartLabels'                 => $chartLabels,
            'chartData'                   => $datasets, // Array flat linear langsung dilempar ke chart
            'tableAggregateVillageData'   => $tableAggregateVillageData,
            'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
        ];
    }

    /**
     * Resolver Tabel 1: Total Per Kategori di Seluruh Desa
     */
    private function resolveTableVillageData(array $labels, array $datasets, int $grandTotal): array
    {
        $baseStructure = [
            'total'        => $grandTotal,
            'totalPercent' => $grandTotal > 0 ? 100 : 0,
            'data'         => [],
        ];

        $baseStructure['data'] = collect($labels)->map(function ($label, $index) use ($datasets, $grandTotal) {
            $total = $datasets[$index] ?? 0;

            return [
                'category' => $label,
                'total'    => $total,
                'percent'  => $grandTotal > 0 ? round(($total / $grandTotal) * 100, 1) : 0,
            ];
        })->all();

        return $baseStructure;
    }

    /**
     * Resolver Tabel 2: Breakdown Kategori per RW / RT
     */
    private function resolveTableTerritoryData(array $labels, array $data): array
    {
        $baseStructure = [
            'data' => [],
        ];

        $territories = $data['by_territory'] ?? [];
        $totalCategories = count($labels);

        foreach ($territories as $territory) {
            // Menghitung total populasi sub-kategori di wilayah RW/RT tersebut
            $totalWilayah = array_sum($territory['datasets'] ?? []);

            foreach ($territory['datasets'] as $index => $count) {
                $baseStructure["data"][] = [
                    'rw'            => $territory['territory']['rw'] ?? 'Tanpa RW',
                    'rt'            => $territory['territory']['rt'] ?? 'Tanpa RT',
                    'category'      => $labels[$index] ?? 'Tidak Diketahui',
                    'total'         => $count,
                    'percent'       => $totalWilayah > 0 ? round(($count / $totalWilayah) * 100, 1) : 0,
                    'is_first'      => $index === 0, // Digunakan frontend untuk pembuka rowspan <td> wilayah
                    'rowspan_count' => $totalCategories,
                ];
            }
        }

        return $baseStructure;
    }
}
