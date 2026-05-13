<?php

namespace App\Models;

use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Citizen extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'citizens';

    protected $fillable = [
        'family_id',
        'id_number',
        'full_name',
        'family_role',
        'gender',
        'birth_place',
        'birth_date',
        'religion',
        'marital_status',
        'blood_type',
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
}
