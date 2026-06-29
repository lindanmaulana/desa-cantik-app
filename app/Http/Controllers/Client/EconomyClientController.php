<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Enums\EconomicType;
use App\Http\Requests\Statistics\EconomicRequest;
use App\Services\Statistics\EconomicService;


class EconomyClientController extends Controller
{
      public function __construct(
        protected EconomicService $economicService,
    ) {}

    public function index(EconomicRequest $request)
    {
        $validated = $request->validated();

        $rwFilter = !empty($validated['rw']) && $validated['rw'] !== 'all' ? $validated['rw'] : null;

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

        return view('client.economy.index', compact('stats'))->with([
            'currentType'                 => $currentType,
            'chartType'                   => $currentType->chartType(),
            'chartLabels'                 => $formatted['chartLabels'],
            'chartData'                   => $formatted['chartData'],
            'data'                        => $data,
        ]);
    }

    public function formatEconomicData(EconomicType $type, array $data)
    {
        $chartLabels = ($type === EconomicType::OCCUPATION) ? ($data['dynamic_labels'] ?? ['Tidak Ada Data']) : $type->labels();

        $maleData = $data["male"] ?? [];
        $femaleData = $data["female"] ?? [];

        $combineData = $this->combineGenderData($maleData, $femaleData);

        $chartData = $this->resolveChartData($type, $maleData, $femaleData, $combineData);
        return [
            'chartLabels'                 => $chartLabels,
            'chartData'                   => $chartData,
        ];
    }

    private function resolveChartData(EconomicType $type, array $maleData, array $femaleData, array $combineData)
    {
        return $this->combineGenderData($maleData, $femaleData);
    }

    public function combineGenderData(array $maleData, array $femaleData): array
    {
        return array_map(function ($maleCount, $femaleCount) {
            return (int)$maleCount + (int)$femaleCount;
        }, $maleData, $femaleData);
    }
}
