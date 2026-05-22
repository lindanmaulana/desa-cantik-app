<?php

namespace App\Services\ManageData;

use App\Models\Citizen;

class CitizenService
{
    public function getStats()
    {
        return Citizen::selectRaw("
            COUNT(*) as total_citizens,
            SUM(CASE WHEN gender = 'male' THEN 1 ELSE 0 END) as total_male,
            SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) as total_female
        ")->first();
    }

    public function getCountMale()
    {
        return Citizen::where('gender', 'male')->count();
    }

    public function getCountFemale()
    {
        return Citizen::where('gender', 'female')->count();
    }
}
