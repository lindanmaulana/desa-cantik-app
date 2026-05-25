<?php

namespace App\Services\ManageData;

use App\Models\Family;

class FamilyService
{
    public function getCount()
    {
        return Family::count();
    }
}
