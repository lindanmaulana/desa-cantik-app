<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\HealthType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\HealthRequest;
use App\Services\ManageData\TerritoriesService;
use App\Services\Statistics\HealthService;

class HealthController extends Controller
{
    public function __construct(
        protected HealthService $healthService,
        protected TerritoriesService $territoriesService
    ) {}

    public function index(HealthRequest $request)
    {
        $validated = $request->validated();

        $rwFilter = !empty($validated['rw']) && $validated['rw'] !== 'all' ? $validated['rw'] : null;
        $rtFilter = !empty($validated['rt']) && $validated['rt'] !== 'all' ? $validated['rt'] : null;

        $stats = $this->healthService->getHealthStats();

        $currentType = HealthType::tryFrom($validated['type'] ?? HealthType::STUNTING_STATUS->value) ?? HealthType::STUNTING_STATUS;

        $data = match ($currentType) {
            HealthType::STUNTING_STATUS => $this->healthService->getStuntingStatus($rwFilter, $rtFilter),
            HealthType::NUTRITIONAL_STATUS => $this->healthService->getNutritionalStatus($rwFilter, $rtFilter),
            HealthType::PREGNANCY => $this->healthService->getPregnancyStatus($rwFilter, $rtFilter),
            HealthType::FAMILY_PLANNING => $this->healthService->getFamilyPlanning($rwFilter, $rtFilter),
            HealthType::BPJS_STATUS => $this->healthService->getBpjsStatus($rwFilter, $rtFilter),
            HealthType::BLOOD_TYPE => $this->healthService->getBloodType($rwFilter, $rtFilter),
            HealthType::DISABILITY => $this->healthService->getDisability($rwFilter, $rtFilter),
        };

        $formatted = $this->formatThematicData($currentType, $data);

        $rwList = $this->territoriesService->getUniqueRwOptions();
        $rtList = $this->territoriesService->getRtOptionsByRw($rwFilter);

        return view('dashboard.statistics.health.index', compact('stats'))->with([
            'currentType' => $currentType,
            'chartType' => $currentType->chartType(),
            'chartLabels' => $formatted['chartLabels'],
            'chartData' => $formatted['chartData'],
            'data' => $data,
            'tableAggregateVillageData' => $formatted['tableAggregateVillageData'],
            'tableAggregateTerritoryData' => $formatted['tableAggregateTerritoryData'],
            'rwList' => $rwList,
            'rtList' => $rtList,
        ]);
    }

    public function formatThematicData(HealthType $type, array $data): array
    {
        $chartLabels = $data['labels'] ?? [];
        $datasets = $data['datasets'] ?? [];
        $grandTotal = array_sum($datasets);

        $tableAggregateVillageData = $this->resolveTableVillageData($chartLabels, $datasets, $grandTotal);
        $tableAggregateTerritoryData = $this->resolveTableTerritoryData($chartLabels, $data);

        return [
            'chartLabels' => $chartLabels,
            'chartData' => $datasets,
            'tableAggregateVillageData' => $tableAggregateVillageData,
            'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
        ];
    }

    private function resolveTableVillageData(array $labels, array $datasets, int $grandTotal): array
    {
        $baseStructure = [
            'total' => $grandTotal,
            'totalPercent' => $grandTotal > 0 ? 100 : 0,
            'data' => [],
        ];

        $baseStructure['data'] = collect($labels)->map(function ($label, $index) use ($datasets, $grandTotal) {
            $total = $datasets[$index] ?? 0;

            return [
                'category' => $label,
                'total' => $total,
                'percent' => $grandTotal > 0 ? round(($total / $grandTotal) * 100, 1) : 0,
            ];
        })->all();

        return $baseStructure;
    }

    private function resolveTableTerritoryData(array $labels, array $data): array
    {
        $baseStructure = [
            'data' => [],
        ];

        $territories = $data['by_territory'] ?? [];
        $totalCategories = count($labels);

        foreach ($territories as $territory) {
            $totalWilayah = array_sum($territory['datasets'] ?? []);

            $datasets = $territory['datasets'] ?? [];
            foreach ($datasets as $index => $count) {
                $baseStructure["data"][] = [
                    'rw' => $territory['territory']['rw'] ?? 'Tanpa RW',
                    'rt' => $territory['territory']['rt'] ?? 'Tanpa RT',
                    'category' => $labels[$index] ?? 'Tidak Diketahui',
                    'total' => $count,
                    'percent' => $totalWilayah > 0 ? round(($count / $totalWilayah) * 100, 1) : 0,
                    'is_first' => $index === 0,
                    'rowspan_count' => $totalCategories,
                ];
            }
        }

        return $baseStructure;
    }
}
