<?php

namespace App\Services\ManageData;

use App\Models\Family;
use App\Models\HousingProfile;
use Illuminate\Support\Facades\DB;

class HousingProfileService
{
    public function store(array $data, Family $family): HousingProfile
    {
        return DB::transaction(function () use ($data, $family) {
            return $family->housingProfile()->create($data);
        });
    }

    public function update(array $data, Family $family): bool
    {
        return DB::transaction(function () use ($data, $family) {
            $housingProfile = $family->housingProfile;

            if (!$housingProfile) {
                return false;
            }

            return $housingProfile->update($data);
        });
    }
}
