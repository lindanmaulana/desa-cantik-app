<?php

namespace App\Models;

use App\Enums\EconomicStatus;
use App\Enums\EmploymentStatus;
use App\Enums\JobSector;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

class EmploymentProfile extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'citizen_id',
        'occupation',
        'job_sector',
        'employment_status',
        'monthly_income',
        'economic_status',
        'is_welfare_recipient',
        'assistance_type'
    ];

    protected function casts(): array
    {
        return [
            'job_sector' => JobSector::class,
            'employment_status' => EmploymentStatus::class,
            'monthly_income' => 'decimal:2',
            'economic_status' => EconomicStatus::class,
            'is_welfare_recipient' => 'boolean'
        ];
    }

    public function citizen() {
        return $this->belongsTo(Citizen::class);
    }
}
