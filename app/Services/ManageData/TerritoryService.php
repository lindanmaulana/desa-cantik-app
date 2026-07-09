<?php

namespace App\Services\ManageData;

use App\Models\Territory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TerritoryService
{
    public function getTerritoryOptions()
    {
        $territories = Territory::select(['id', 'rt', 'rw', 'sub_village'])
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => "Dusun {$item->sub_village} - RW {$item->rw} / RT {$item->rt}"];
            });

        return $territories;
    }

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

    public function checkDuplicateTerritory(array $data): bool
    {
        $isDuplicate = Territory::where('rw', $data['rw'])->where('rt', $data['rt'])->exists();

        if ($isDuplicate) {
            throw new \InvalidArgumentException("Wilayah dengan RT{$data['rt']} dan RW{$data['rw']} sudah terdaftar");
        }

        return false;
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
