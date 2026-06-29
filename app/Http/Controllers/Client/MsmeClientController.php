<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Enums\MsmeType;
use App\Http\Requests\Statistics\MsmeRequest;
use App\Services\ManageData\TerritoryService;
use App\Services\Statistics\MsmeService;

class MsmeClientController extends Controller
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

    return view('client.msme.index', compact('stats'))->with([
      'currentType'                 => $currentType,
      'chartType'                   => $currentType->chartType(),
      'chartLabels'                 => $formatted['chartLabels'],
      'chartData'                   => $formatted['chartData'],
      'data'                        => $data,
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

    return [
      'chartLabels'                 => $chartLabels,
      'chartData'                   => $chartData,
    ];
  }

  private function resolveChartData(MsmeType $type, array $maleData, array $femaleData, array $combineData)
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
