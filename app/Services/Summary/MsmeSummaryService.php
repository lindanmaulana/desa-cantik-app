<?php

namespace App\Services\Summary;

use App\Models\Msme;

class MsmeSummaryService
{
    public function getSummary()
    {
        return [
            ...$this->getTotalMsme(),
        ];
    }


    public function getTotalMsme()
    {
        return [
            'totalMsme' => Msme::count()
        ];
    }
}
