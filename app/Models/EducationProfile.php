<?php

namespace App\Models;

use App\Enums\EducationLevel;
use App\Enums\SchoolParticipation;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

class EducationProfile extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'citizen_id',
        'education_level',
        'highest_diploma',
        'school_participation'
    ];

    protected function casts(): array
    {
        return [
            'education_level' => EducationLevel::class,
            'highest_diploma' => EducationLevel::class,
            'school_participation' => SchoolParticipation::class
        ];
    }

    public function citizen() {
        return $this->belongsTo(Citizen::class);
    }
}
