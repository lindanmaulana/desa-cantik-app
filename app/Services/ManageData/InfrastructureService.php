<?php

namespace App\Services\ManageData;

use App\Models\Infrastructure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InfrastructureService
{
    public function getStats()
    {
        return (object) [
            'total_Assets'   => Infrastructure::count(),
            'good_Condition' => Infrastructure::where('condition', 'good')->count(),
            'damaged_Assets' => Infrastructure::whereIn('condition', ['damaged_light', 'damaged_severe'])->count(),
        ];
    }

    public function getAll(array $filters)
    {
        $query = Infrastructure::query();

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('facility_name', 'like', "%{$search}%")
                    ->orWhere('funding_source', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['facility_type'])) {
            $query->where('facility_type', $filters['facility_type']);
        }

        if (!empty($filters['condition'])) {
            $query->where('condition', $filters['condition']);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function create(array $data)
    {
        $data['id'] = Str::uuid()->toString();

        DB::transaction(fn() => Infrastructure::create($data));
    }

    public function update(Infrastructure $infrastructure, array $data)
    {
        return DB::transaction(fn() => $infrastructure->update($data));
    }

    public function delete(Infrastructure $infrastructure)
    {
        return DB::transaction(fn() => $infrastructure->delete());
    }
}
