<?php

namespace App\Models;

use App\Enums\BloodType;
use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Citizen extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $keyType = 'string';
    protected $table = 'citizens';
    public $incrementing = false;

    protected $fillable = [
        'family_id',
        'id_number',
        'full_name',
        'family_role',
        'gender',
        'birth_place',
        'birth_date',
        'religion',
        'blood_type',
        'marital_status',
    ];

    protected function casts(): array
    {
        return [
            'family_role' => FamilyRole::class,
            'gender' => Gender::class,
            'religion' => Religion::class,
            'blood_type' => BloodType::class,
            'marital_status' => MaritalStatus::class,
            'birth_date' => 'date'
        ];
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function educationProfile()
    {
        return $this->hasOne(EducationProfile::class);
    }

    public function employmentProfile()
    {
        return $this->hasOne(EmploymentProfile::class);
    }

    public function healthProfile()
    {
        return $this->hasOne(HealthProfile::class);
    }

    public function childGrowthLogs()
    {
        return $this->hasMany(ChildGrowthLog::class);
    }

    public function msmes()
    {
        return $this->hasMany(Msme::class, 'citizen_id');
    }

    public function spatialData()
    {
        return $this->morphOne(SpatialData::class, 'feature');
    }

    protected function isToddler(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->birth_date ? $this->birth_date->age < 5 : false,
        );
    }
}
