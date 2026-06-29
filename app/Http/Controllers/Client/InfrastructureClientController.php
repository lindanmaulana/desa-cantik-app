<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Enums\InfrastructureType;
use App\Http\Requests\Statistics\InfrastructureRequest;
use App\Services\ManageData\TerritoryService;
use App\Services\Statistics\InfrastructureService;

class InfrastructureClientController extends Controller
{
      public function __construct(
        protected InfrastructureService $infrastructureService,
        protected TerritoryService $territoriesService
    ) {}

    public function index(InfrastructureRequest $request)
    {
        $validated = $request->validated();

        $stats = $this->infrastructureService->getInfrastructureStats();

        $currentType = InfrastructureType::tryFrom($validated['type'] ?? InfrastructureType::FACILITY_TYPE->value) ?? InfrastructureType::FACILITY_TYPE;

        $data = match ($currentType) {
            InfrastructureType::FACILITY_TYPE     => $this->infrastructureService->getVillageAggregation($currentType->value, $currentType->options()),
            InfrastructureType::CONDITION         => $this->infrastructureService->getVillageAggregation($currentType->value, $currentType->options()),
            InfrastructureType::CONSTRUCTION_YEAR => $this->infrastructureService->getVillageAggregation($currentType->value, $currentType->options()),
        };

        $formatted = $this->formatInfrastructureData($currentType, $data);

        return view('client.infrastructure.index', compact('stats'))->with([
            'currentType'                 => $currentType,
            'chartType'                   => $currentType->chartType(),
            'chartLabels'                 => $formatted['chartLabels'],
            'chartData'                   => $formatted['chartData'],
            'data'                        => $data,
        ]);
    }

    public function formatInfrastructureData(InfrastructureType $type, array $data): array
    {
        $chartLabels = $type === InfrastructureType::CONSTRUCTION_YEAR
            ? collect($data['data'])->pluck('category')->all()
            : array_values($type->options());

        $chartData = collect($data['data'])->pluck('total')->all();

        return [
            'chartLabels'                 => $chartLabels,
            'chartData'                   => $chartData,
        ];
    }
}
