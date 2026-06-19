<?php

namespace App\Models;

use App\Enums\BumdesPartnershipStatus;
use App\Enums\BusinessCategory;
use App\Enums\CapitalSource;
use App\Enums\DigitalPlatformType;
use App\Enums\LegalEntityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Msme extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'msmes';

    protected $fillable = [
        'citizen_id',
        'business_name',
        'business_category',
        'license_number',
        'employee_count',
        'mothly_revenue',
        'legal_entity_type',
        'uses_digital_payment',
        'capital_source',
        'is_environmentally_friendly',
        'bumdes_partnership_status'
    ];

    protected function casts(): array {
        return [
            'business_category' => BusinessCategory::class,
            'employee_count' => 'integer',
            'mothly_revenue' => 'decimal:2',
            'legal_entity_type' => LegalEntityType::class,
            'uses_digital_payment' => 'boolean',
            'digital_platform_type' => DigitalPlatformType::class,
            'capital_source' => CapitalSource::class,
            'is_environmentally_friendly' => 'boolean',
            'bumdes_partnership_status' => BumdesPartnershipStatus::class,
        ];
    }

    public function citizen() {
        return $this->belongsTo(Citizen::class);
    }

    public function spatialData() {
        return $this->morphOne(SpatialData::class, 'feature');
    }
}
