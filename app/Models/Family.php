<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Family extends Model
{
    use HasFactory, HasUuids;

    protected $table = "families";

    protected $fillable = [
        'territory_id',
        'family_card_number',
        'address_detail',
    ];

    public function territory() {
        return $this->belongsTo(Territory::class);
    }
}
