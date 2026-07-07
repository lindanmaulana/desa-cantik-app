<?php

namespace App\Services\Statistics;

use App\Models\HousingProfile;

class HousingProfileService
{
    private function getSummary()
    {
        return [
            'totalHouses' => HousingProfile::count()
        ];
    }
}
