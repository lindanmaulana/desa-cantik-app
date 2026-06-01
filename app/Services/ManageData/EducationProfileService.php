<?php

namespace App\Services\ManageData;

use App\Models\Citizen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EducationProfileService
{
    public function create(Citizen $citizen, array $data)
    {
        $data['id'] = Str::uuid()->toString();

        DB::transaction(function () use ($citizen, $data) {
            return $citizen->educationProfile()->create($data);
        });
    }

    public function update(Citizen $citizen, array $data)
    {
        return DB::transaction(function () use ($citizen, $data) {
            $citizen->educationProfile()->update($data);
        });
    }
}
