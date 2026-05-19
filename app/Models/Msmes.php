<?php

namespace App\Models;

use App\Enums\BusinessCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Msmes extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'msmes';

    protected $fillable = [
        'citizen_id',
        'business_name',
        'business_category',
        'license_number',
        'employee_count',
        'mothly_revenue'
    ];

    protected function casts(): array {
        return [
            'business_category' => BusinessCategory::class,
            'employee_count' => 'integer',
            'mothly_revenue' => 'decimal:2',
        ];
    }

    public function citizen() {
        return $this->belongsTo(Citizen::class);
    }

    public function spatialData() {
        return $this->morphOne(SpatialData::class, 'feature');
    }
}
