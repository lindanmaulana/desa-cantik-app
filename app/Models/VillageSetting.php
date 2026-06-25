<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VillageSetting extends Model
{
    use HasFactory;

    protected $table = 'village_settings';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'village_name',
        'village_code',
        'subdistrict_name',
        'regency_name',
        'province_name',
        'village_head_name',
        'village_head_nip',
        'app_title',
        'village_logo',
        'hero_image',
        'office_address',
        'postal_code',
        'official_email',
        'phone_number',
        'latitude',
        'longitude',
        'facebook_url',
        'youtube_url',
        'instagram_url',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];
}
