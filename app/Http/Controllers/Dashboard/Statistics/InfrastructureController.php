<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\InfrastructureType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\InfrastructureRequest;
use App\Services\ManageData\TerritoryService;
use App\Services\Statistics\InfrastructureService;

class InfrastructureController extends Controller
{
    public function __construct(
        protected InfrastructureService $infrastructureService,
        protected TerritoryService $territoriesService
    ) {}

    public function index(InfrastructureRequest $request)
    {
        $validated = $request->validated();
        $rwFilter = !empty($validated['rw']) && $validated['rw'] !== 'all' ? $validated['rw'] : null;
        $rtFilter = !empty($validated['rt']) && $validated['rt'] !== 'all' ? $validated['rt'] : null;

        $stats = $this->infrastructureService->getInfrastructureStats();

        $currentType = InfrastructureType::tryFrom($validated['type'] ?? InfrastructureType::FACILITY_TYPE->value) ?? InfrastructureType::FACILITY_TYPE;

        $data = match ($currentType) {
            InfrastructureType::FACILITY_TYPE     => $this->infrastructureService->getVillageAggregation($currentType->value, $currentType->options()),
            InfrastructureType::CONDITION         => $this->infrastructureService->getVillageAggregation($currentType->value, $currentType->options()),
            InfrastructureType::CONSTRUCTION_YEAR => $this->infrastructureService->getVillageAggregation($currentType->value, $currentType->options()),
        };

        $formatted = $this->formatInfrastructureData($currentType, $data);
        $rwList = $this->territoriesService->getUniqueRwOptions();
        $rtList = $this->territoriesService->getRtOptionsByRw($rwFilter);

        return view('dashboard.statistics.infrastructure.index', compact('stats'))->with([
            'currentType'                 => $currentType,
            'chartType'                   => $currentType->chartType(),
            'chartLabels'                 => $formatted['chartLabels'],
            'chartData'                   => $formatted['chartData'],
            'data'                        => $data,
            'tableAggregateVillageData'   => $formatted['tableAggregateVillageData'],
            'tableAggregateTerritoryData' => $formatted['tableAggregateTerritoryData'],
            'rwList'                      => $rwList,
            'rtList'                      => $rtList,
        ]);
    }

    public function formatInfrastructureData(InfrastructureType $type, array $data): array
    {
        $chartLabels = $type === InfrastructureType::CONSTRUCTION_YEAR
            ? collect($data['data'])->pluck('category')->all()
            : array_values($type->options());

        $chartData = collect($data['data'])->pluck('total')->all();

        $tableAggregateVillageData = [
            'total'        => $data['total'] ?? 0,
            'totalPercent' => ($data['total'] ?? 0) > 0 ? 100 : 0,
            'data'         => $data['data'] ?? [],
        ];

        $tableAggregateTerritoryData = $this->resolveTableTerritoryData($type, $chartLabels, $data);

        return [
            'chartLabels'                 => $chartLabels,
            'chartData'                   => $chartData,
            'tableAggregateVillageData'   => $tableAggregateVillageData,
            'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
        ];
    }


    private function resolveTableTerritoryData(InfrastructureType $type, array $labels, ?array $data): array
    {
        $baseStructure = [
            'total' => $data['total'] ?? 0,
            'data'  => [],
        ];

        $territories = $data['by_territory'] ?? [];
        $totalCategories = count($labels);

        foreach ($territories as $territory) {
            $totalWilayah = array_sum($territory['counts'] ?? []);

            foreach ($labels as $index => $label) {
                $count = $territory['counts'][$index] ?? 0;

                $baseStructure['data'][] = [
                    'rw'            => $territory['territory']['rw'] ?? 'Tanpa RW',
                    'rt'            => $territory['territory']['rt'] ?? 'Tanpa RT',
                    'category'      => $label,
                    'total'         => $count,
                    'percent'       => $totalWilayah > 0 ? round(($count / $totalWilayah) * 100, 1) : 0,
                    'is_first'      => $index === 0,
                    'rowspan_count' => $totalCategories,
                ];
            }
        }

        return $baseStructure;
    }
}
