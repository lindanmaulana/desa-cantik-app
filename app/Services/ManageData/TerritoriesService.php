<?php

namespace App\Services\ManageData;

use App\Http\Requests\Territories\getAllTerritoryRequest;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TerritoriesService
{
    public function getAll(array $request)
    {
        $query = Territory::query();

        if ($request['search'] ?? false) {
            $search = $request['search'];

            $query->where(function ($q) use ($search) {
                $q->whereAny([
                    'sub_village',
                    'area_name',
                    'rw',
                    'rt'
                ], 'like', "%{$search}%");
            });
        }

        if ($request['sub_village'] ?? false) {
            $query->where('sub_village', $request['sub_village']);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function getCount()
    {
        $counts = Territory::selectRaw("
            COUNT(DISTINCT sub_village) as total_SubVillage,
            COUNT(DISTINCT rw) as total_RW,
            COUNT(DISTINCT rt) as total_RT
        ")->first();

        return $counts;
    }

    public function getUniqueRwOptions()
    {
        return Territory::select('rw', 'sub_village')
            ->groupBy('rw', 'sub_village')
            ->orderBy('rw', 'asc')
            ->get();
    }

    public function getRtOptionsByRw(?string $rw)
    {
        if (!$rw || $rw === 'all') {
            return [];
        }

        return Territory::select('rt')
            ->where('rw', $rw)
            ->orderBy('rt', 'asc')
            ->get();
    }

    public function create(array $data)
    {
        $data['id'] = Str::uuid()->toString();

        return DB::transaction(fn() => Territory::create($data));
    }

    public function update(Territory $territory, array $data)
    {
        return DB::transaction(fn() => $territory->update($data));
    }

    public function delete(Territory $territory)
    {
        return DB::transaction(fn() => $territory->delete());
    }
}
