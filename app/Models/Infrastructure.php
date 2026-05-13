<?php

namespace App\Models;

use App\Enums\ConditionInfrastructure;
use App\Enums\FacilityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Infrastructure extends Model
{
    use HasFactory, HasUuids;

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
}
