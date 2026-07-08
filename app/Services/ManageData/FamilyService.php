<?php

namespace App\Services\ManageData;

use App\Models\Family;
use App\Models\Citizen;
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
        return (object) [
            'total_families'   => Family::count(),
            'total_subvillage' => DB::table('territories')
                ->select('rw')
                ->whereNull('deleted_at')
                ->whereNotNull('rw')
                ->where('rw', '<>', '')
                ->groupBy('rw')
                ->get()
                ->count(),
            'total_citizens'   => Citizen::count(),
        ];
    }

    public function getFamilies()
    {
        return Family::all();
    }

    public function getFamilyOptions()
    {
        $families = Family::select(['id', 'family_card_number'])->get()->mapWithKeys(function ($item) {
            return [$item->id => "KK: {$item->family_card_number}"];
        });

        return $families;
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

    public function getFamilyDetail(Family $family)
    {
        $result = $family->load([
            'territory',
            'housingProfile',
            'citizens' => function ($query) {
                $query->select(['id', 'family_id', 'full_name', 'id_number', 'family_role', 'gender', 'birth_date'])
                    ->orderBy('family_role', 'asc');
            }
        ]);

        return $result;
    }

    public function checkDuplicateFamilyCardNumber(array $data, ?string $ignoreId = null): bool
    {
        $query = Family::where('family_card_number', $data['family_card_number']);

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $isDuplicate = $query->exists();

        if ($isDuplicate) {
            throw new \InvalidArgumentException("Nomor KK {$data['family_card_number']} sudah terdaftar");
        }

        return false;
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
