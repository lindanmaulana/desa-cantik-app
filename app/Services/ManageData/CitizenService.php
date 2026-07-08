<?php

namespace App\Services\ManageData;

use App\Enums\BloodType;
use App\Models\Citizen;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitizenService
{
    public function getStats()
    {
        return (object) [
            'total_Citizens' => Citizen::count(),
            'total_Male'     => Citizen::where('gender', 'male')->count(),
            'total_Female'   => Citizen::where('gender', 'female')->count(),
        ];
    }

    public function getAll(array $filters)
    {
        $query = Citizen::with([
            'family',
            'educationProfile',
            'employmentProfile',
            'healthProfile',
            'childGrowthLogs'
        ]);

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('id_number', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['gender'])) {
            $query->where('gender', $filters['gender']);
        }

        if (!empty($filters['religion'])) {
            $query->where('religion', $filters['religion']);
        }

        if (!empty($filters['marital_status'])) {
            $query->where('marital_status', $filters['marital_status']);
        }

        if (!empty($filters['family_id'])) {
            $query->where('family_id', $filters['family_id']);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function getCountMale()
    {
        return Citizen::where('gender', "male")->count();
    }

    public function getCountFemale()
    {
        return Citizen::where('gender', 'female')->count();
    }

    public function getCitizenOptions(): Collection
    {
        return Citizen::orderBy('full_name')->get();
    }

    public function getDetail(Citizen $citizen)
    {
        return $citizen->load([
            'family.territory',
            'educationProfile',
            'employmentProfile',
            'healthProfile',
            'childGrowthLogs' => function ($query) {
                $query->latest()->limit(3);
            }
        ]);
    }

    public function create(array $data): Citizen
    {
        $data['id'] = Str::uuid()->toString();
        $data['blood_type'] = $data['blood_type'] ?? BloodType::NOT_KNOWN->value;

        return DB::transaction(fn() => Citizen::create($data));
    }

    public function update(Citizen $citizen, array $data)
    {
        return DB::transaction(fn() => $citizen->update($data));
    }

    public function delete(Citizen $citizen)
    {
        return DB::transaction(fn() => $citizen->delete());
    }
}
