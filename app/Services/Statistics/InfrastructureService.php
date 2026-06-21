<?php

namespace App\Services\Statistics;

use App\Models\Infrastructure;
use Illuminate\Support\Facades\DB;

class InfrastructureService
{
    public function getInfrastructureStats(): object
    {
        return (object) [
            'total_facilities' => DB::table('infrastructures')->whereNull('deleted_at')->count(),
            'good_condition' => DB::table('infrastructures')->whereNull('deleted_at')->where('condition', 'good')->count(),
            'damaged_facilities' => DB::table('infrastructures')->whereNull('deleted_at')->whereIn('condition', ['damaged_light', 'damaged_severe'])->count(),
        ];
    }

    public function getVillageAggregation(string $column, array $categories): array
    {
        $query = DB::table('infrastructures')->whereNull('deleted_at');

        if ($column === 'construction_year') {
            $raw = $query->select($column, DB::raw('COUNT(*) as total'))
                ->groupBy($column)
                ->orderBy($column, 'asc')
                ->get();

            $totalAll = $raw->sum('total');
            $formattedData = $raw->map(function ($row) use ($totalAll) {
                return [
                    'category' => $row->construction_year ?? 'Tanpa Tahun',
                    'total' => (int) $row->total,
                    'percent' => $totalAll > 0 ? number_format(($row->total / $totalAll) * 100, 2) : '0.00'
                ];
            })->all();

            return [
                'total' => $totalAll,
                'data' => $formattedData
            ];
        }

        $selectStatements = [];
        foreach ($categories as $key => $value) {
            $selectStatements[] = "SUM(CASE WHEN `{$column}` = '{$key}' THEN 1 ELSE 0 END) as `count_{$key}`";
        }

        $result = $query->selectRaw(implode(", ", $selectStatements))->first();

        $data = [];
        $totalAll = 0;
        foreach ($categories as $key => $value) {
            $count = (int) ($result->{"count_{$key}"} ?? 0);
            $totalAll += $count;
            $data[] = [
                'key' => $key,
                'category' => $value,
                'total' => $count,
            ];
        }

        foreach ($data as &$item) {
            $item['percent'] = $totalAll > 0 ? number_format(($item['total'] / $totalAll) * 100, 2) : '0.00';
        }

        return [
            'total' => $totalAll,
            'data' => $data
        ];
    }
}
