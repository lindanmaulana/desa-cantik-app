<?php

namespace App\Models;

use App\Enums\EconomicStatus;
use App\Enums\EducationLevel;
use App\Enums\HouseCondition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SocialEconomic extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'social_economics';

    protected $fillable = [
        'citizen_id',
        'education_level',
        'occupation',
        'monthly_income',
        'is_welfare_recipient',
        'assistance_type',
        'house_condition',
        'economic_status',
    ];

    protected function casts(): array {
        return [
            'education_level' => EducationLevel::class,
            'is_welfare_recipient' => 'boolean',
            'house_condition' => HouseCondition::class,
            'economic_status' => EconomicStatus::class,
        ];
    }

    public function citizen() {
        return $this->belongsTo(Citizen::class);
    }
}
