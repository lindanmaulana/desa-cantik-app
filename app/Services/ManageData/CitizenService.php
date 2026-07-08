<?php

namespace App\Services\ManageData;

use App\Enums\Gender;
use App\Http\Requests\Citizens\StoreCitizenRequest;
use App\Models\Citizen;
use App\Models\Family;
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



    // public function create(array $data): Citizen
    // {
    //     $validated['id'] = Str::uuid()->toString();
    //     return DB::transaction(function () use ($data) {
    //         $citizenData = collect($data)->only([
    //             'id',
    //             'family_id',
    //             'full_name',
    //             'id_number',
    //             'family_card_number',
    //             'gender',
    //             'birth_place',
    //             'birth_date',
    //             'religion',
    //             'marital_status',
    //             'blood_type'
    //         ])->toArray();

    //         $citizen = Citizen::create($citizenData);

    //         // 2. Simpan ke Profil Pendidikan
    //         $citizen->educationProfile()->create(collect($data)->only([
    //             'education_level',
    //             'highest_diploma',
    //             'school_participation'
    //         ])->toArray());

    //         // 3. Simpan ke Profil Pekerjaan
    //         $citizen->employmentProfile()->create(collect($data)->only([
    //             'occupation',
    //             'job_sector',
    //             'employment_status',
    //             'monthly_income',
    //             'economic_status',
    //             'is_welfare_recipient',
    //             'assistance_type'
    //         ])->toArray());

    //         // 4. Simpan ke Profil Kesehatan
    //         $citizen->healthProfile()->create(collect($data)->only([
    //             'disability_type',
    //             'is_pregnant',
    //             'kb_method',
    //             'bpjs_status'
    //         ])->toArray());

    //         // 5. Simpan ke Kondisi Rumah
    //         $citizen->housingProfile()->create(collect($data)->only([
    //             'house_ownership',
    //             'house_condition',
    //             'floor_material',
    //             'wall_material',
    //             'roof_material',
    //             'water_source',
    //             'sanitation_type',
    //             'cooking_fuel',
    //             'electricity_source',
    //             'electricity_capacity'
    //         ])->toArray());
    //     });
    // }
}
