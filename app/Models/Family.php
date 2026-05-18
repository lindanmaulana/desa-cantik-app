<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Family extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $keyType = 'string';
    protected $table = "families";
    public $incrementing = false;

    protected $fillable = [
        'territory_id',
        'family_card_number',
        'address_detail',
    ];

    public function territory() {
        return $this->belongsTo(Territory::class);
    }

    public function citizens() {
        return $this->hasMany(Citizen::class);
    }
}
