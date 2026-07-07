<?php

namespace App\Services\Summary;

use App\Models\HousingProfile;

class HousingProfileSummaryService
{
    public function getSummary() {
        return [
            ...$this->getTotalHouses(),
        ];
    }

    public function getTotalHouses()
    {
        return [
            'totalHouses' => HousingProfile::count()
        ];
    }
}
