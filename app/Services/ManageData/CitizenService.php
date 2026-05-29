<?php

namespace App\Services\ManageData;

use App\Models\Citizen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CitizenService
{
    public function getStats()
    {
        return Citizen::selectRaw("
            COUNT(*) as total_citizens,
            SUM(CASE WHEN gender = 'male' THEN 1 ELSE 0 END) as total_male,
            SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) as total_female
        ")->first();
    }

    public function getCountMale()
    {
        return Citizen::where('gender', 'male')->count();
    }

    public function getCountFemale()
    {
        return Citizen::where('gender', 'female')->count();
    }

    public function create(array $data): Citizen
    {
        $validated['id'] = Str::uuid()->toString();
        return DB::transaction(function () use ($data) {
            $citizenData = collect($data)->only([
                'id',
                'family_id',
                'full_name',
                'id_number',
                'family_card_number',
                'gender',
                'birth_place',
                'birth_date',
                'religion',
                'marital_status',
                'blood_type'
            ])->toArray();

            $citizen = Citizen::create($citizenData);

            // 2. Simpan ke Profil Pendidikan
            $citizen->educationProfile()->create(collect($data)->only([
                'education_level',
                'highest_diploma',
                'school_participation'
            ])->toArray());

            // 3. Simpan ke Profil Pekerjaan
            $citizen->employmentProfile()->create(collect($data)->only([
                'occupation',
                'job_sector',
                'employment_status',
                'monthly_income',
                'economic_status',
                'is_welfare_recipient',
                'assistance_type'
            ])->toArray());

            // 4. Simpan ke Profil Kesehatan
            $citizen->healthProfile()->create(collect($data)->only([
                'disability_type',
                'is_pregnant',
                'kb_method',
                'bpjs_status'
            ])->toArray());

            // 5. Simpan ke Kondisi Rumah
            $citizen->housingProfile()->create(collect($data)->only([
                'house_ownership',
                'house_condition',
                'floor_material',
                'wall_material',
                'roof_material',
                'water_source',
                'sanitation_type',
                'cooking_fuel',
                'electricity_source',
                'electricity_capacity'
            ])->toArray());
        });
    }
}
