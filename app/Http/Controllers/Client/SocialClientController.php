<?php

namespace App\Http\Controllers\Client;

use App\Enums\SocialType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Statistics\SocialRequest;
use App\Services\Statistics\SocialService;

class SocialClientController extends Controller
{
    public function __construct(
        protected SocialService $socialService,
    ) {}

    public function index(SocialRequest $request)
    {
        $validated = $request->validated();

        $stats = $this->socialService->getSocialStats();

        $currentType = SocialType::tryFrom($validated['type'] ?? SocialType::RELIGION->value) ?? SocialType::RELIGION;

        $data = match ($currentType) {
            SocialType::RELIGION     => $this->socialService->getReligion($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::SCHOOL_PARTICIPATION => $this->socialService->getSchoolParticipation($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::EDUCATION_LEVEL => $this->socialService->getEducationLevel($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::HIGHEST_DIPLOMA => $this->socialService->getHighestDiploma($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::WELFARE_ASSISTANCE   => $this->socialService->getSocialAssistanceStatus($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::SANITATION   => $this->socialService->getSanitation($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::WATER_SOURCE   => $this->socialService->getWaterSource($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::ELECTRICITY_SOURCE   => $this->socialService->getElectricitySource($validated["rw"] ?? null, $validated["rt"] ?? null),
            SocialType::ELECTRICITY_CAPACITY   => $this->socialService->getElectricityCapacity($validated["rw"] ?? null, $validated["rt"] ?? null),
        };

        $formatted = $this->formatThematicData($currentType, $data);

        return view('client.social.index', compact('stats'))->with([
            'currentType'                  => $currentType,
            'chartType'                    => $currentType->chartType(),
            'chartLabels'                  => $formatted['chartLabels'],
            'chartData'                    => $formatted['chartData'],
            'data'                         => $data,
        ]);
    }

    public function formatThematicData(SocialType $type, array $data): array
    {
        $chartLabels = $data['labels'] ?? [];
        $datasets    = $data['datasets'] ?? [];

        return [
            'chartLabels'                 => $chartLabels,
            'chartData'                   => $datasets,
        ];
    }
}
