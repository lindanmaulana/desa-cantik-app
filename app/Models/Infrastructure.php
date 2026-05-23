<?php

namespace App\Models;

use App\Enums\ConditionInfrastructure;
use App\Enums\FacilityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infrastructure extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'infrastructures';

    protected $fillable = [
        'facility_name',
        'facility_type',
        'condition',
        'construction_year',
        'funding_source',
    ];

    protected function casts(): array {
        return [
            'facility_type' => FacilityType::class,
            'condition' => ConditionInfrastructure::class,
            'construction_year' => 'integer',
        ];
    }

    public function spatialData() {
        return $this->morphOne(SpatialData::class, 'feature');
    }
}
