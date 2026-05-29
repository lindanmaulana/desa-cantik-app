<?php

namespace App\Models;

use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
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

    protected function casts(): array {
        return [
            'family_role' => FamilyRole::class,
            'gender' => Gender::class,
            'religion' => Religion::class,
            'marital_status' => MaritalStatus::class,
        ];
    }

    public function family() {
        return $this->belongsTo(Family::class);
    }

    public function educationProfile() {
        return $this->hasOne(EducationProfiles::class);
    }

    public function employmentProfile() {
        return $this->hasOne(EmploymentProfiles::class);
    }

    public function healthProfile() {
        return $this->hasOne(HealthProfiles::class);
    }

    public function childGrowthLogs() {
        return $this->hasOne(ChildGrowthLogs::class);
    }

    public function msmes() {
        return $this->hasMany(Msme::class, 'citizen_id');
    }

    public function spatialData() {
        return $this->morphOne(SpatialData::class, 'feature');
    }
}
