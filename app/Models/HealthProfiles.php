<?php

namespace App\Models;

use App\Enums\BpjsStatus;
use App\Enums\DisabilityType;
use App\Enums\KbMethod;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthProfiles extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'citizen_id',
        'disability_type',
        'is_pregnant',
        'kb_method',
        'bpjs_status',
    ];

    protected function casts(): array {
        return [
            'disability_type' => DisabilityType::class,
            'is_pregnant' => 'boolean',
            'kb_method' => KbMethod::class,
            'bpjs_status' => BpjsStatus::class,
        ];
    }

    public function citizen() {
        return $this->belongsTo(Citizen::class);
    }
}
