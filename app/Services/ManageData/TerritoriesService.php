<?php

namespace App\Services\ManageData;

use App\Models\Territory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TerritoriesService
{
    public function create(array $data)
    {
        $data['id'] = Str::uuid()->toString();

        return DB::transaction(fn() => Territory::create($data));
    }

    public function update(Territory $territory, array $data)
    {
        return DB::transaction(fn() => $territory->update($data));
    }

    public function delete(Territory $territory) {
        return DB::transaction(fn() => $territory->delete());
    }
}
