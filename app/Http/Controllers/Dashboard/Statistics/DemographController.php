<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\DemographicsType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\DemographRequest;
use App\Services\ManageData\TerritoriesService;
use App\Services\Statistics\DemographService;

class DemographController extends Controller
{
    public function __construct(protected DemographService $demographService, protected TerritoriesService $territoriesService) {}

    public function index(DemographRequest $request)
    {
        $validated = $request->validated();

        $stats = $this->demographService->getDemographicStats();
        $currentType = DemographicsType::tryFrom($validated['type'] ?? DemographicsType::AGE_GROUP->value) ?? DemographicsType::AGE_GROUP;

        $data = match ($currentType) {
            DemographicsType::AGE_GROUP => $this->demographService->getAgeGroup($validated["rw"] ?? null),
            DemographicsType::GENDER => $this->demographService->getGender(),
            DemographicsType::MARITAL_STATUS => $this->demographService->getMaritalStatus($validated["rw"] ?? null),
            DemographicsType::TERRITORY => $this->demographService->getTerritory($validated['rw'] ?? null),
            DemographicsType::CITIZEN_STATUS => $this->demographService->getStatusCitizen($validated["rw"] ?? null),
        };

        $formatted = $this->formatDemographicsData($currentType, $data);
        $territories = $this->territoriesService->getAll([]);

        return view('dashboard.statistics.demographics.index', compact('stats'))->with([
            'currentType' => $currentType,
            'chartType'   => $currentType->chartType(),
            'chartLabels' => $formatted['chartLabels'],
            'chartData' => $formatted['chartData'],
            'data'        => $data,
            'tableAggregateVillageData' => $formatted['tableAggregateVillageData'],
            'tableAggregateTerritoryData' => $formatted["tableAggregateTerritoryData"],
            'territories' => $territories,
        ]);
    }

    public function formatDemographicsData(DemographicsType $type, array $data)
    {
        $chartLabels = ($type === DemographicsType::TERRITORY) ? $data['labels'] : $type->labels();

        $maleData = $data["male"] ?? [];
        $femaleData = $data["female"] ?? [];

        if ($type === DemographicsType::AGE_GROUP) {
        }

        $combineData = $this->combineGenderData($maleData, $femaleData);
        $grandTotal = array_sum($combineData);
        $chartData = $this->resolveChartData($type, $maleData, $femaleData, $combineData);
        $tableAggregateVillageData = $this->resolveTableVillageData($type, $chartLabels, $data, $grandTotal, $maleData, $femaleData);
        $tableAggregateTerritoryData = $this->resolveTableTerritoryData($type, $maleData, $femaleData, $data);

        return [
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'tableAggregateVillageData' => $tableAggregateVillageData,
            'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
        ];
    }

    private function resolveChartData(DemographicsType $type, array $maleData, array $femaleData, array $combineData)
    {
        if ($type && $type === DemographicsType::GENDER) {
            return [
                'male' => array_sum($maleData),
                'female' => array_sum($femaleData)
            ];
        }

        if ($type && $type !== DemographicsType::GENDER) {
            return $this->combineGenderData($maleData, $femaleData);
        }

        return ['male' => [], 'female' => []];
    }

    private function resolveTableVillageData(DemographicsType $type, array $labels, array $data, int $grandTotal, array $maleData, array $femaleData): array
    {
        $baseStructure = [
            "maleTotal"   => array_sum($maleData),
            "femaleTotal" => array_sum($femaleData),
            'total'       => $grandTotal,
            'totalPercent' => 0,
            "data"        => [],
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

    private function resolveTableTerritoryData(DemographicsType $type, array $maleData, array $femaleData, ?array $data)
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
                    'rw'       => $territory['territory']['rw'] ?? 'Tanpa RW',
                    'rt'       => $territory['territory']['rt'] ?? 'Tanpa RT',
                    'category' => $type->labels()[$index] ?? 'Tidak Diketahui',
                    'male'     => $maleCount,
                    'female'   => $femaleCount,
                    'total'    => $totalPerKategori,
                    'percent'  => $totalWilayah > 0 ? round(($totalPerKategori / $totalWilayah) * 100, 1) : 0,
                    'is_first' => $index === 0,
                    'rowspan_count'  => $totalCategories,
                ];
            }
        }

        return $baseStructure;
    }

    // private function resolveTableTerritoryData(DemographicsType $type, array $maleData, array $femaleData, ?array $data)
    // {
    //     $baseStructure = [
    //         "maleTotal"   => array_sum($maleData),
    //         "femaleTotal" => array_sum($femaleData),
    //         "data"        => [],
    //     ];

    //     if ($type === DemographicsType::AGE_GROUP) {
    //         $formattedData = [];
    //         $territories = $data['by_territory'] ?? [];
    //         $totalCategories = count($type->labels());

    //         foreach ($territories as $territory) {
    //             $totalWilayah = array_sum($territory['male']) + array_sum($territory['female']);

    //             foreach ($territory['male'] as $index => $maleCount) {
    //                 $femaleCount = $territory['female'][$index] ?? 0;
    //                 $totalPerKategori = $maleCount + $femaleCount;

    //                 $formattedData[] = [
    //                     'rw'       => $territory['territory']['rw'] ?? 'Tanpa RW',
    //                     'rt'       => $territory['territory']['rt'] ?? 'Tanpa RT',
    //                     'category' => $type->labels()[$index] ?? 'Tidak Diketahui',
    //                     'male'     => $maleCount,
    //                     'female'   => $femaleCount,
    //                     'total'    => $totalPerKategori,
    //                     'percent'  => $totalWilayah > 0 ? round(($totalPerKategori / $totalWilayah) * 100, 1) : 0,
    //                     'is_first' => $index === 0,
    //                     'rowspan_count'  => $totalCategories,
    //                 ];
    //             }
    //         }

    //         $baseStructure['data'] = $formattedData;
    //     }

    //     if ($type === DemographicsType::GENDER) {
    //         $formatted = [];

    //         // Handle logika gender jika ada
    //     }

    //     if ($type === DemographicsType::MARITAL_STATUS) {
    //         $formattedData = [];
    //         $territories = $data['by_territory'] ?? [];

    //         foreach ($territories as $territory) {
    //             $totalWilayah = array_sum($territory['male']) + array_sum($territory['female']);

    //             foreach ($territory['male'] as $index => $maleCount) {
    //                 $femaleCount = $territory['female'][$index] ?? 0;
    //                 $totalPerKategori = $maleCount + $femaleCount;

    //                 $formattedData[] = [
    //                     'rw'       => $territory['territory']['rw'] ?? 'Tanpa RW',
    //                     'rt'       => $territory['territory']['rt'] ?? 'Tanpa RT',
    //                     'category' => $type->labels()[$index] ?? 'Tidak Diketahui',
    //                     'male'     => $maleCount,
    //                     'female'   => $femaleCount,
    //                     'total'    => $totalPerKategori,
    //                     'percent'  => $totalWilayah > 0 ? round(($totalPerKategori / $totalWilayah) * 100, 1) : 0,
    //                     'is_first' => $index === 0,
    //                 ];
    //             }
    //         }

    //         $baseStructure['data'] = $formattedData;
    //     }

    //     return $baseStructure;
    // }

    public function combineGenderData(array $maleData, array $femaleData): array
    {
        return array_map(function ($maleCount, $femaleCount) {
            return (int)$maleCount + (int)$femaleCount;
        }, $maleData, $femaleData);
    }
}
