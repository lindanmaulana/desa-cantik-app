<?php

namespace App\Services\ManageData;

use App\Models\Citizen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChildGrowthLogService
{
    public function create(Citizen $citizen, array $data)
    {
        $data['id'] = Str::uuid()->toString();

        DB::transaction(function () use ($citizen, $data) {
            return $citizen->childGrowthLogs()->create($data);
        });
    }

    public function update(Citizen $citizen, array $data)
    {
        return DB::transaction(function () use ($citizen, $data) {
            $citizen->childGrowthLogs()->update($data);
        });
    }
}
