<?php

namespace App\Services\ManageData;

use App\Models\Citizen;
use App\Models\HealthProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HealthProfileService
{
    public function create(Citizen $citizen, array $data)
    {
        $data['id'] = Str::uuid()->toString();

        DB::transaction(function () use ($citizen, $data) {
            return $citizen->healthProfile()->create($data);
        });
    }

    public function update(Citizen $citizen, array $data)
    {
        return DB::transaction(function () use ($citizen, $data) {
            $healthProfile = $citizen->healthProfile;

            if ($healthProfile) {
                return $healthProfile->update($data);
            }

            $data['id'] = Str::uuid()->toString();
            return $citizen->healthProfile()->update($data);
        });
    }
}
