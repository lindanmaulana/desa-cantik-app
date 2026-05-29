<?php

namespace App\Models;

use App\Enums\MeasurementMethod;
use App\Enums\StuntingStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildGrowthLogs extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'citizen_id',
        'measured_at',
        'weight',
        'height',
        'measurement_method',
        'vit_a_received',
        'stunting_status',
        'recorded_by',
        'notes'
    ];


    protected function casts(): array
    {
        return [
            'measurement_method' => MeasurementMethod::class,
            'stunting_status' => StuntingStatus::class
        ];
    }

    public function citizen() {
        return $this->belongsTo(Citizen::class);
    }
}
