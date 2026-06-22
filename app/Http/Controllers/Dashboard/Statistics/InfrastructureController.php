<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\InfrastructureType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\InfrastructureRequest;
use App\Services\ManageData\TerritoriesService;
use App\Services\Statistics\InfrastructureService;

class InfrastructureController extends Controller
{
  public function __construct(
    protected InfrastructureService $infrastructureService,
    protected TerritoriesService $territoriesService
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
    $territories = $this->territoriesService->getAll([]);

    return view('dashboard.statistics.infrastructure.index', compact('stats'))->with([
      'currentType'                 => $currentType,
      'chartType'                   => $currentType->chartType(),
      'chartLabels'                 => $formatted['chartLabels'],
      'chartData'                   => $formatted['chartData'],
      'data'                        => $data,
      'tableAggregateVillageData'   => $formatted['tableAggregateVillageData'],
      'tableAggregateTerritoryData' => $formatted['tableAggregateTerritoryData'],
      'territories'                 => $territories,
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

    $tableAggregateTerritoryData = [
      'total' => $data['total'] ?? 0,
      'data'  => [],
    ];

    return [
      'chartLabels'                 => $chartLabels,
      'chartData'                   => $chartData,
      'tableAggregateVillageData'   => $tableAggregateVillageData,
      'tableAggregateTerritoryData' => $tableAggregateTerritoryData,
    ];
  }
}
