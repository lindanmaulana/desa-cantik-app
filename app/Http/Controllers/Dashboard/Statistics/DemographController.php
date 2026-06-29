<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\DemographicsType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\DemographRequest;
use App\Services\ManageData\TerritoryService;
use App\Services\Statistics\DemographService;

class DemographController extends Controller
{
    public function __construct(
        protected DemographService $demographService,
        protected TerritoryService $territoriesService
    ) {}

    public function index(DemographRequest $request)
    {
        $validated = $request->validated();

        $rwFilter = !empty($validated['rw']) && $validated['rw'] !== 'all' ? $validated['rw'] : null;
        $rtFilter = !empty($validated['rt']) && $validated['rt'] !== 'all' ? $validated['rt'] : null;

        $stats = $this->demographService->getDemographicStats();

        $currentType = DemographicsType::tryFrom($validated['type'] ?? DemographicsType::AGE_GROUP->value) ?? DemographicsType::AGE_GROUP;

        $data = match ($currentType) {
            DemographicsType::AGE_GROUP     => $this->demographService->getAgeGroup($rwFilter, $rtFilter),
            DemographicsType::GENDER        => $this->demographService->getGender($rwFilter, $rtFilter),
            DemographicsType::MARITAL_STATUS => $this->demographService->getMaritalStatus($rwFilter, $rtFilter),
            DemographicsType::TERRITORY     => $this->demographService->getTerritory($rwFilter, $rtFilter),
            DemographicsType::CITIZEN_STATUS => $this->demographService->getStatusCitizen($rwFilter, $rtFilter),
        };

        $formatted = $this->formatDemographicsData($currentType, $data);
        $rwList = $this->territoriesService->getUniqueRwOptions();
        $rtList = $this->territoriesService->getRtOptionsByRw($rwFilter);

        return view('dashboard.statistics.demographics.index', compact('stats'))->with([
            'currentType'                 => $currentType,
            'chartType'                   => $currentType->chartType(),
            'chartLabels'                 => $formatted['chartLabels'],
            'chartData'                   => $formatted['chartData'],
            'data'                        => $data,
            'tableAggregateVillageData'   => $formatted['tableAggregateVillageData'],
            'tableAggregateTerritoryData' => $formatted["tableAggregateTerritoryData"],
            'rwList'                      => $rwList,
            'rtList'                      => $rtList,
        ]);
    }

    public function formatDemographicsData(DemographicsType $type, array $data)
    {
        $chartLabels = ($type === DemographicsType::TERRITORY) ? ($data['labels'] ?? []) : $type->labels();

        $maleData = $data["male"] ?? [];
        $femaleData = $data["female"] ?? [];

        $combineData = $this->combineGenderData($maleData, $femaleData);
        $grandTotal = array_sum($combineData);

        $chartData = $this->resolveChartData($type, $maleData, $femaleData, $combineData);
        $tableAggregateVillageData = $this->resolveTableVillageData($type, $chartLabels, $data, $grandTotal, $maleData, $femaleData);

        $tableAggregateTerritoryData = $this->resolveTableTerritoryData($type, $data, $chartLabels);

        return [
            'chartLabels'                 => $chartLabels,
            'chartData'                   => $chartData,
            'tableAggregateVillageData'   => $tableAggregateVillageData,
            'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
        ];
    }

    private function resolveChartData(DemographicsType $type, array $maleData, array $femaleData, array $combineData)
    {
        if ($type === DemographicsType::GENDER) {
            return [
                'male'   => array_sum($maleData),
                'female' => array_sum($femaleData)
            ];
        }

        return $combineData;
    }

    private function resolveTableVillageData(DemographicsType $type, array $labels, array $data, int $grandTotal, array $maleData, array $femaleData): array
    {
        $baseStructure = [
            "maleTotal"    => array_sum($maleData),
            "femaleTotal"  => array_sum($femaleData),
            'total'        => $grandTotal,
            'totalPercent' => $grandTotal > 0 ? 100 : 0,
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

    private function resolveTableTerritoryData(DemographicsType $type, ?array $data, array $chartLabels = [])
    {
        $calculatedMaleTotal = 0;
        $calculatedFemaleTotal = 0;
        $formattedRows = [];

        if ($type === DemographicsType::TERRITORY) {
            $territories = $data['by_territory'] ?? [];

            $grandTotalWilayah = 0;
            foreach ($territories as $territory) {
                $grandTotalWilayah += array_sum($territory['male'] ?? [0]) + array_sum($territory['female'] ?? [0]);
            }

            foreach ($territories as $territory) {
                $maleCount = array_sum($territory['male'] ?? [0]);
                $femaleCount = array_sum($territory['female'] ?? [0]);
                $totalPerKategori = $maleCount + $femaleCount;

                $calculatedMaleTotal += $maleCount;
                $calculatedFemaleTotal += $femaleCount;

                $formattedRows[] = [
                    'rw'            => $territory['territory']['rw'] ?? 'Tanpa RW',
                    'rt'            => $territory['territory']['rt'] ?? 'Tanpa RT',
                    'category'      => 'Total Penduduk',
                    'male'          => $maleCount,
                    'female'        => $femaleCount,
                    'total'         => $totalPerKategori,
                    'percent'       => $grandTotalWilayah > 0 ? round(($totalPerKategori / $grandTotalWilayah) * 100, 1) : 0,
                    'is_first'      => true,
                    'rowspan_count' => 1,
                ];
            }

            return [
                "maleTotal"   => $calculatedMaleTotal,
                "femaleTotal" => $calculatedFemaleTotal,
                "data"        => $formattedRows,
            ];
        }

        $territories = $data['by_territory'] ?? [];
        $totalCategories = count($type->labels());

        foreach ($territories as $territory) {
            $territoryMaleSum = array_sum($territory['male']);
            $territoryFemaleSum = array_sum($territory['female']);
            $totalWilayah = $territoryMaleSum + $territoryFemaleSum;

            $calculatedMaleTotal += $territoryMaleSum;
            $calculatedFemaleTotal += $territoryFemaleSum;

            foreach ($territory['male'] as $index => $maleCount) {
                $femaleCount = $territory['female'][$index] ?? 0;
                $totalPerKategori = $maleCount + $femaleCount;

                $formattedRows[] = [
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

        return [
            "maleTotal"   => $calculatedMaleTotal,
            "femaleTotal" => $calculatedFemaleTotal,
            "data"        => $formattedRows,
        ];
    }

    public function combineGenderData(array $maleData, array $femaleData): array
    {
        $max = max(count($maleData), count($femaleData));
        $combined = [];
        for ($i = 0; $i < $max; $i++) {
            $combined[] = (int)($maleData[$i] ?? 0) + (int)($femaleData[$i] ?? 0);
        }
        return $combined;
    }
}
