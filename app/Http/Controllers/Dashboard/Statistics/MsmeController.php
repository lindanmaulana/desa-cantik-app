<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\MsmeType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\MsmeRequest;
use App\Services\ManageData\TerritoryService;
use App\Services\Statistics\MsmeService;

class MsmeController extends Controller
{
    public function __construct(
        protected MsmeService $msmeService,
        protected TerritoryService $territoriesService
    ) {}

    public function index(MsmeRequest $request)
    {
        $validated = $request->validated();
        $rwFilter = !empty($validated['rw']) && $validated['rw'] !== 'all' ? $validated['rw'] : null;
        $rtFilter = !empty($validated['rt']) && $validated['rt'] !== 'all' ? $validated['rt'] : null;

        $stats = $this->msmeService->getUmkmMacroStats();
        $currentType = MsmeType::tryFrom($validated['type'] ?? MsmeType::BUSINESS_SECTOR->value) ?? MsmeType::BUSINESS_SECTOR;

        $data = match ($currentType) {
            MsmeType::BUSINESS_SECTOR    => $this->msmeService->getBusinessSector($rwFilter, $rtFilter),
            MsmeType::OWNER_AGE          => $this->msmeService->getOwnerAge($rwFilter, $rtFilter),
            MsmeType::OWNER_EDUCATION    => $this->msmeService->getOwnerEducation($rwFilter, $rtFilter),
            MsmeType::BUSINESS_LOCATION  => $this->msmeService->getBusinessLocation($rwFilter, $rtFilter),
            MsmeType::LEGAL_STATUS       => $this->msmeService->getLegalStatus($rwFilter, $rtFilter),
            MsmeType::NIB_OWNERSHIP      => $this->msmeService->getNibOwnership($rwFilter, $rtFilter),
            MsmeType::MONTHLY_TURNOVER   => $this->msmeService->getMonthlyTurnover($rwFilter, $rtFilter),
            MsmeType::DIGITAL_TRANSACTION => $this->msmeService->getDigitalTransaction($rwFilter, $rtFilter),
            MsmeType::DIGITAL_PLATFORM   => $this->msmeService->getDigitalPlatform($rwFilter, $rtFilter),
            MsmeType::CAPITAL_SOURCE     => $this->msmeService->getCapitalSource($rwFilter, $rtFilter),
            MsmeType::ECO_FRIENDLY       => $this->msmeService->getEcoFriendly($rwFilter, $rtFilter),
            MsmeType::BUMDES_PARTNERSHIP => $this->msmeService->getBumdesPartnership($rwFilter, $rtFilter),
        };

        $formatted = $this->formatUmkmData($currentType, $data);
        $rwList = $this->territoriesService->getUniqueRwOptions();
        $rtList = $this->territoriesService->getRtOptionsByRw($rwFilter);

        return view('dashboard.statistics.msme.index', compact('stats'))->with([
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

    public function formatUmkmData(MsmeType $type, array $data)
    {
        $chartLabels = $type->labels();

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

    private function resolveChartData(MsmeType $type, array $maleData, array $femaleData, array $combineData)
    {
        return $this->combineGenderData($maleData, $femaleData);
    }

    private function resolveTableVillageData(MsmeType $type, array $labels, array $data, int $grandTotal, array $maleData, array $femaleData): array
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

    private function resolveTableTerritoryData(MsmeType $type, array $maleData, array $femaleData, ?array $data)
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
