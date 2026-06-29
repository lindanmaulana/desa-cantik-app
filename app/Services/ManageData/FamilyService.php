<?php

namespace App\Services\ManageData;

use App\Models\Family;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;


class FamilyService
{
    public function getCount()
    {
        return Family::count();
    }

    public function getStats(): object
    {
        return (object) DB::selectOne("
            SELECT
                (SELECT COUNT(*) FROM families) as total_Families,
                (SELECT COUNT(DISTINCT sub_village) FROM territories) as total_SubVillage,
                (SELECT COUNT(*) FROM citizens) as total_Citizens
        ");
    }

    public function getFamilies()
    {
        return Family::all();
    }

    public function getAll(array $filters): LengthAwarePaginator
    {
        $query = Family::with(['territory', 'citizens']);

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->whereAny([
                    'family_card_number'
                ], 'like', "%{$search}%")
                    ->orWhereHas('territory', function ($qt) use ($search) {
                        $qt->whereAny([
                            'sub_village',
                            'area_name',
                        ], 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($filters['territory_id'])) {
            $query->where('territory_id', $filters['territory_id']);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function create(array $data)
    {
        $data['id'] = Str::uuid()->toString();

        DB::transaction(fn() => Family::create($data));
    }

    public function update(Family $family, array $data)
    {
        return DB::transaction(fn() => $family->update($data));
    }

    public function delete(Family $family)
    {
        return DB::transaction(fn() => $family->delete());
    }
}
