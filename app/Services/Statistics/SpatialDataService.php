<?php

namespace App\Services\Statistics;

use App\Models\SpatialData;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SpatialDataService
{
    public function getSpatialStats(): array
    {
        $rawStats = SpatialData::select('feature_type', DB::raw('count(*) as total'))
            ->groupBy('feature_type')
            ->pluck('total', 'feature_type')
            ->toArray();

        return [
            'resident_house'   => $rawStats['resident_house'] ?? 0,
            'public_facility'  => $rawStats['public_facility'] ?? 0,
            'msme_location'    => $rawStats['msme_location'] ?? 0,
            'village_boundary' => $rawStats['village_boundary'] ?? 0,
        ];
    }

    public function getSpatialRegistry(int $perPage = 5, ?string $search = null): LengthAwarePaginator
    {
        $query = SpatialData::query()->latest();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        return $query->paginate($perPage);
    }
}
