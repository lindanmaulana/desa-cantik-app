<?php

namespace App\Http\Controllers\Dashboard\Statistics;

use App\Enums\DemographicsType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\DemographRequest;
use App\Models\Citizen;
use App\Models\Family;
use App\Services\CitizenService;
use App\Services\FamilyService;
use App\Services\Statistics\DemographService;
use Illuminate\Http\Request;

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

        return view('dashboard.statistics.demographics.index', compact('stats'))->with([
            'currentType' => $currentType,
            'chartType'   => $currentType->chartType(),
            'chartLabels' => $currentType->labels(),
            'data'        => $data,
        ]);
    }
}
