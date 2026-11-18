<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class StatisticsExport implements Export, FromArray, ShouldAutoSize, WithHeadings, WithTitle
{
    public function __construct(
        protected array $report,
        protected ?string $sheetTitle = null,
    ) {}

    public function array(): array
    {
        $rows = [];

        foreach ($this->report['rows'] as $row) {
            if ($row['male'] !== null) {
                $rows[] = [
                    $row['category'],
                    $row['male'],
                    $row['female'],
                    $row['total'],
                    $row['percent'].'%',
                ];
            } else {
                $rows[] = [
                    $row['category'],
                    '-',
                    '-',
                    $row['total'],
                    $row['percent'].'%',
                ];
            }
        }

        $rows[] = ['', '', '', $this->report['total'], ''];

        return $rows;
    }

    public function headings(): array
    {
        return ['Kategori', 'Laki-laki', 'Perempuan', 'Total', 'Persentase'];
    }

    public function title(): string
    {
        $title = $this->sheetTitle ?: $this->report['title'];

        return substr(preg_replace('/[^A-Za-z0-9 ]/', '', $title), 0, 31);
    }
}
