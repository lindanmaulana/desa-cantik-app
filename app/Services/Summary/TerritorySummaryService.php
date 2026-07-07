<?php

namespace App\Services\Summary;

use App\Models\Territory;

class TerritorySummaryService
{
    public function getSummary()
    {
        $stats = Territory::selectRaw("
        COUNT(DISTINCT sub_village) as totalHamlets,
        COUNT(DISTINCT CONCAT(sub_village, '-', rw)) as totalRw,
        COUNT(DISTINCT CONCAT(sub_village, '-', rw, '-', rt)) as totalRt
    ")->first();

        return [
            'totalHamles' => (int) $stats->totalHamlets,
            'totalRw' => (int) $stats->totalRw,
            'totalRt' => (int) $stats->totalRt,
        ];
    }

    public function getTotalHamles()
    {
        return [
            'totalHamles' => Territory::distinct('sub_village')
                ->count('sub_village')
        ];
    }

    public function getTotalRw()
    {
        return [
            'totalRw' => Territory::select('sub_village', 'rw')
                ->distinct()
                ->count()
        ];
    }

    public function getTotalRt()
    {
        return [
            'totalRt' => Territory::select('sub_village', 'rw', 'rt')
                ->distinct()
                ->count(),
        ];
    }
}
