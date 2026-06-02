<?php

namespace App\Services\ManageData;

use App\Models\Citizen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EmploymentProfileService
{
    public function create(Citizen $citizen, array $data)
    {
        $data['id'] = Str::uuid()->toString();

        DB::transaction(function () use ($citizen, $data) {
            $citizen->employmentProfile()->create($data);
        });
    }

    public function update(Citizen $citizen, array $data)
    {
        DB::transaction(function () use ($citizen, $data) {
            $citizen->employmentProfile()->update($data);
        });
    }
}
