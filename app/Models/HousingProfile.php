<?php

namespace App\Models;

use App\Enums\CookingFuel;
use App\Enums\ElectricityCapacity;
use App\Enums\ElectricitySource;
use App\Enums\FloorMaterial;
use App\Enums\HouseCondition;
use App\Enums\RoofMaterial;
use App\Enums\SanitationType;
use App\Enums\WallMaterial;
use App\Enums\WaterSource;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

class HousingProfile extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'family_id',
        'house_ownership',
        'house_condition',
        'floor_material',
        'wall_material',
        'roof_material',
        'water_source',
        'sanitation_type',
        'cooking_fuel',
        'electricity_source',
        'electricity_capacity',
    ];

    protected function casts(): array
    {
        return [
            'house_condition' => HouseCondition::class,
            'floor_material' => FloorMaterial::class,
            'wall_material' => WallMaterial::class,
            'roof_material' => RoofMaterial::class,
            'water_source' => WaterSource::class,
            'sanitation_type' => SanitationType::class,
            'cooking_fuel' => CookingFuel::class,
            'electricity_source' => ElectricitySource::class,
            'electricity_capacity' => ElectricityCapacity::class
        ];
    }

    public function family() {
        return $this->belongsTo(Family::class);
    }
}
