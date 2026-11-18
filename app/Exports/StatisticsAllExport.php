<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StatisticsAllExport implements Export, WithMultipleSheets
{
    public function __construct(protected array $reports) {}

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->reports as $report) {
            $sheets[] = new StatisticsExport($report);
        }

        return $sheets;
    }
}
