<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\DemographRequest;
use App\Enums\DemographicsType;
use App\Services\Statistics\DemographService;

class DemographClientController extends Controller
{
  public function __construct(protected DemographService $demographService) {}

  public function index(DemographRequest $request)
  {
    $validated = $request->validated();

    $stats = $this->demographService->getDemographicStats();

    $currentType = DemographicsType::tryFrom($validated['type'] ?? DemographicsType::AGE_GROUP->value) ?? DemographicsType::AGE_GROUP;

    $data = match ($currentType) {
      DemographicsType::AGE_GROUP     => $this->demographService->getAgeGroup(),
      DemographicsType::GENDER        => $this->demographService->getGender(),
      DemographicsType::MARITAL_STATUS => $this->demographService->getMaritalStatus(),
      DemographicsType::TERRITORY     => $this->demographService->getTerritory(),
      DemographicsType::CITIZEN_STATUS => $this->demographService->getStatusCitizen(),
    };

    $formatted = $this->formatDemographicsData($currentType, $data);

    return view('client.demograph.index', compact('stats'))->with([
      'currentType'                 => $currentType,
      'chartType'                   => $currentType->chartType(),
      'chartLabels'                 => $formatted['chartLabels'],
      'chartData'                   => $formatted['chartData'],
      'data'                        => $data,
    ]);
  }

  public function formatDemographicsData(DemographicsType $type, array $data)
  {
    $chartLabels = ($type === DemographicsType::TERRITORY) ? ($data['labels'] ?? []) : $type->labels();

    $maleData = $data["male"] ?? [];
    $femaleData = $data["female"] ?? [];

    $combineData = $this->combineGenderData($maleData, $femaleData);
    // $grandTotal = array_sum($combineData);

    $chartData = $this->resolveChartData($type, $maleData, $femaleData, $combineData);

    return [
      'chartLabels'                 => $chartLabels,
      'chartData'                   => $chartData,
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
