<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\EconomicType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\EconomicRequest;
use App\Services\ManageData\TerritoriesService;
use App\Services\Statistics\EconomicService;

class EconomicController extends Controller
{
    public function __construct(
        protected EconomicService $economicService,
        protected TerritoriesService $territoriesService
    ) {}

    public function index(EconomicRequest $request)
    {
        $validated = $request->validated();

        $rwFilter = !empty($validated['rw']) && $validated['rw'] !== 'all' ? $validated['rw'] : null;
        $rtFilter = !empty($validated['rt']) && $validated['rt'] !== 'all' ? $validated['rt'] : null;

        $stats = $this->economicService->getEconomicStats();
        $currentType = EconomicType::tryFrom($validated['type'] ?? EconomicType::OCCUPATION->value) ?? EconomicType::OCCUPATION;

        $data = match ($currentType) {
            EconomicType::OCCUPATION           => $this->economicService->getOccupation($rwFilter),
            EconomicType::JOB_SECTOR          => $this->economicService->getJobSector($rwFilter),
            EconomicType::EMPLOYMENT_STATUS    => $this->economicService->getEmploymentStatus($rwFilter),
            EconomicType::HOUSE_OWNERSHIP      => $this->economicService->getHouseOwnership($rwFilter),
            EconomicType::FLOOR_MATERIAL       => $this->economicService->getFloorMaterial($rwFilter),
            EconomicType::WALL_MATERIAL        => $this->economicService->getWallMaterial($rwFilter),
            EconomicType::ROOF_MATERIAL        => $this->economicService->getRoofMaterial($rwFilter),
            EconomicType::COOKING_FUEL         => $this->economicService->getCookingFuel($rwFilter),
            EconomicType::ELECTRICITY_SOURCE => $this->economicService->getElectricitySource($rwFilter),
            EconomicType::ELECTRICITY_CAPACITY => $this->economicService->getElectricityCapacity($rwFilter),
            EconomicType::ECONOMIC_STATUS      => $this->economicService->getEconomicStatus($rwFilter),
        };

        $formatted = $this->formatEconomicData($currentType, $data);

        $rwList = $this->territoriesService->getUniqueRwOptions();
        $rtList = $this->territoriesService->getRtOptionsByRw($rwFilter);

        return view('dashboard.statistics.economic.index', compact('stats'))->with([
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

    public function formatEconomicData(EconomicType $type, array $data)
    {
        $chartLabels = ($type === EconomicType::OCCUPATION) ? ($data['dynamic_labels'] ?? ['Tidak Ada Data']) : $type->labels();

        $maleData = $data["male"] ?? [];
        $femaleData = $data["female"] ?? [];

        $combineData = $this->combineGenderData($maleData, $femaleData);
        $grandTotal = array_sum($combineData);

        $chartData = $this->resolveChartData($type, $maleData, $femaleData, $combineData);
        $tableAggregateVillageData = $this->resolveTableVillageData($type, $chartLabels, $data, $grandTotal, $maleData, $femaleData);
        $tableAggregateTerritoryData = $this->resolveTableTerritoryData($type, $maleData, $femaleData, $data);

        return [
            'chartLabels'                 => $chartLabels,
            'chartData'                   => $chartData,
            'tableAggregateVillageData'   => $tableAggregateVillageData,
            'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
        ];
    }

    private function resolveChartData(EconomicType $type, array $maleData, array $femaleData, array $combineData)
    {
        return $this->combineGenderData($maleData, $femaleData);
    }

    private function resolveTableVillageData(EconomicType $type, array $labels, array $data, int $grandTotal, array $maleData, array $femaleData): array
    {
        $baseStructure = [
            "maleTotal"    => array_sum($maleData),
            "femaleTotal"  => array_sum($femaleData),
            'total'        => $grandTotal,
            'totalPercent' => 0,
            "data"         => [],
        ];

        $baseStructure['data'] = collect($labels)->map(function ($label, $index) use ($data, $grandTotal) {
            $male = $data['male'][$index] ?? 0;
            $female = $data['female'][$index] ?? 0;
            $total = $male + $female;

            return [
                'category' => $label,
                'male'     => $male,
                'female'   => $female,
                'total'    => $total,
                'percent'  => $grandTotal > 0 ? round(($total / $grandTotal) * 100, 1) : 0,
            ];
        })->all();

        return $baseStructure;
    }

    private function resolveTableTerritoryData(EconomicType $type, array $maleData, array $femaleData, ?array $data)
    {
        $baseStructure = [
            "maleTotal"   => array_sum($maleData),
            "femaleTotal" => array_sum($femaleData),
            "data"        => [],
        ];

        $territories = $data['by_territory'] ?? [];
        $totalCategories = count($type->labels());

        foreach ($territories as $territory) {
            $totalWilayah = array_sum($territory['male']) + array_sum($territory['female']);

            foreach ($territory['male'] as $index => $maleCount) {
                $femaleCount = $territory['female'][$index] ?? 0;
                $totalPerKategori = $maleCount + $femaleCount;

                $baseStructure["data"][] = [
                    'rw'            => $territory['territory']['rw'] ?? 'Tanpa RW',
                    'rt'            => $territory['territory']['rt'] ?? 'Tanpa RT',
                    'category'      => $type->labels()[$index] ?? 'Tidak Diketahui',
                    'male'          => $maleCount,
                    'female'        => $femaleCount,
                    'total'         => $totalPerKategori,
                    'percent'       => $totalWilayah > 0 ? round(($totalPerKategori / $totalWilayah) * 100, 1) : 0,
                    'is_first'      => $index === 0,
                    'rowspan_count' => $totalCategories,
                ];
            }
        }

        return $baseStructure;
    }

    public function combineGenderData(array $maleData, array $femaleData): array
    {
        return array_map(function ($maleCount, $femaleCount) {
            return (int)$maleCount + (int)$femaleCount;
        }, $maleData, $femaleData);
    }
}
