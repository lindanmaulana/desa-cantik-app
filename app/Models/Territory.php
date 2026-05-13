<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Territory extends Model
{
    use HasFactory, HasUuids;

    protected $table = "territories";

    protected $fillable = [
        "sub_village",
        "area_name",
        "rt",
        "rw"
    ];

    public function families() {
        return $this->hasMany(Family::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
