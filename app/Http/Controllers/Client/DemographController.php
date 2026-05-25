<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\DemographRequest;
use App\Enums\DemographicsType;
use App\Services\Statistics\DemographService;

class DemographController extends Controller
{
  public function __construct(protected DemographService $demographService) {}

  public function index(DemographRequest $request)
  {
    $validated = $request->validated();

    $stats = $this->demographService->getDemographicStats();

    $currentType = DemographicsType::tryFrom($validated['type'] ?? DemographicsType::AGE_GROUP->value) ?? DemographicsType::AGE_GROUP;
    $data = match ($currentType) {
      DemographicsType::AGE_GROUP => $this->demographService->getAgeGroup(),
      DemographicsType::GENDER => $this->demographService->getGender(),
      DemographicsType::MARITAL_STATUS => $this->demographService->getMaritalStatus(),
    };

    return view('client.demografi', compact('stats'))->with([
      'currentType' => $currentType,
      'chartType'   => $currentType->chartType(),
      'chartLabels' => $currentType->labels(),
      'data'        => $data,
    ]);
  }
}
