<?php

namespace App\Services\ManageData;

use App\Models\Citizen;
use App\Models\Msme;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MsmeService
{
    public function getStats(): object
    {
        return (object) [
            'total_Msmes'     => Msme::count(),
            'total_Employees' => Msme::sum('employee_count'),
            'total_Revenue'   => Msme::sum('monthly_revenue') ?? 0.00,
        ];
    }
    
    public function getAll(array $filters)
    {
        $query = Msme::with('citizen');

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                    ->orWhere('license_number', 'like', "%{$search}%")
                    ->orWhereHas('citizen', function ($qc) use ($search) {
                        $qc->where('full_name', 'like', "%{$search}%")
                            ->orWhere('id_number', 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($filters['business_category'])) {
            $query->where('business_category', $filters['business_category']);
        }

        return $query->latest()->paginate(10)->withQueryString();
    }

    public function create(array $data)
    {
        $data['id'] = Str::uuid()->toString();

        DB::transaction(fn() => Msme::create($data));
    }

    public function update(Msme $msme, array $data)
    {
        return DB::transaction(fn() => $msme->update($data));
    }

    public function delete(Msme $msme)
    {
        return DB::transaction(fn() => $msme->delete());
    }
}
