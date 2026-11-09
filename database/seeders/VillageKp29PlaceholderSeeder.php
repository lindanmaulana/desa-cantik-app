<?php

namespace Database\Seeders;

use App\Models\VillageSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VillageKp29PlaceholderSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            foreach ([
                'child_growth_logs',
                'housing_profiles',
                'health_profiles',
                'employment_profiles',
                'education_profiles',
                'msmes',
                'infrastructures',
                'spatial_data',
                'citizens',
                'families',
            ] as $table) {
                DB::table($table)->delete();
            }

            VillageSetting::updateOrCreate(
                ['id' => VillageSetting::query()->value('id') ?? (string) Str::uuid()],
                [
                    'village_name' => 'Desa KP 29',
                    'village_code' => '00000000',
                    'subdistrict_name' => 'Kecamatan KP 29',
                    'regency_name' => 'Kabupaten KP 29',
                    'province_name' => 'Provinsi Jawa Barat',
                    'village_head_name' => 'Kepala Desa KP 29',
                    'village_head_nip' => '000000000000000000',
                    'app_title' => 'Desa KP 29',
                    'office_address' => 'Kantor Desa KP 29, Kecamatan KP 29',
                    'postal_code' => '00000',
                    'official_email' => 'admin@desakp29.local',
                    'phone_number' => '080000000029',
                    'latitude' => null,
                    'longitude' => null,
                    'facebook_url' => null,
                    'youtube_url' => null,
                    'instagram_url' => null,
                ]
            );
        });

        $this->command?->info('Placeholder Desa KP 29 disiapkan dan data statistik dikosongkan.');
    }
}
