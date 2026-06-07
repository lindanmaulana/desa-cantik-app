<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\DemographicsType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\DemographRequest;
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
            DemographicsType::TERRITORY => $this->demographService->getTerritory($validated['rw'] ?? null),
        };

        return view('dashboard.statistics.demographics.index', compact('stats'))->with([
            'currentType' => $currentType,
            'chartType'   => $currentType->chartType(),
            'chartLabels' => $currentType->labels(),
            'data'        => $data,
        ]);
    }
}
