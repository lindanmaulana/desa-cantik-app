<?php

namespace App\Services\Summary;

use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Models\Citizen;

class CitizenSummaryService
{
    public function getSummary(): array
    {
        $stats = Citizen::selectRaw("
            COUNT(*) as totalCitizens,
            SUM(CASE WHEN gender = 'male' THEN 1 ELSE 0 END) as totalMale,
            SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) as totalFemale,
            SUM(CASE WHEN family_role = 'head_of_family' THEN 1 ELSE 0 END) as totalHeadOfFamily
        ")->first();

        return [
            'totalCitizens'       => (int) $stats->totalCitizens,
            'totalMale'       => (int) $stats->totalMale,
            'totalFemale'      => (int) $stats->totalFemale,
            'totalHeadOfFamily' => (int) $stats->totalHeadOfFamily,
        ];
    }

    public function getTotalCitizens() {
        return [
            'totalCitizens' => Citizen::count(),
        ];
    }

    public function getTotalMale() {
        return [
            'totalMale' => Citizen::where('gender', Gender::MALE->value)->count(),
        ];
    }

    public function getTotalFemale() {
        return [
            'totalFemale' => Citizen::where('gender', Gender::FEMALE->value)->count()
        ];
    }

    public function getTotalHeadOfFamily() {
        return [
            'totalHeadOfFamily' => Citizen::where('family_role', FamilyRole::HEAD_OF_FAMILY->value)->count()
        ];
    }
}
