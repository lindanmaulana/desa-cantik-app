<?php

namespace App\Models;

use App\Enums\FeatureType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SpatialData extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'spatial_data';

    protected $fillable = [
        'feature_id',
        'feature_type',
        'latitude',
        'longtitude',
        'geojson',
    ];

    protected function casts(): array {
        return [
            'feature_type' => FeatureType::class,
            'latitude' => 'float',
            'longtitude' => 'float',
            'geojson' => 'array',
        ];
    }

    public function feature() {
        return $this->morphTo();
    }
}
