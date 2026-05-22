<?php

namespace App\Models;

use App\Enums\FeatureType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpatialData extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'spatial_data';

    protected $fillable = [
        'feature_id',
        'feature_type',
        'latitude',
        'longitude',
        'geojson',
    ];

    protected function casts(): array {
        return [
            'feature_type' => FeatureType::class,
            'latitude' => 'float',
            'longitude' => 'float',
            'geojson' => 'array',
        ];
    }

    public function feature(): MorphTo {
        return $this->morphTo();
    }
}
