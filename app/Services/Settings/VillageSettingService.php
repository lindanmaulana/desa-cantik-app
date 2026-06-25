<?php

namespace App\Services\Settings;

use App\Models\VillageSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VillageSettingService
{
    protected string $cacheKey  = 'village_settings_global';

    public function getSettings(): ?VillageSetting
    {
        return Cache::rememberForever($this->cacheKey, function () {
            return VillageSetting::first();
        });
    }

    public function storeSettings(array $data): VillageSetting
    {
        return DB::transaction(function () use ($data) {
            $data['id'] = (string) Str::uuid();

            $settings = VillageSetting::create($data);

            Cache::forget($this->cacheKey);

            return $settings;
        });
    }

    public function updateSettings(array $data): VillageSetting
    {
        return DB::transaction(function () use ($data) {
            $settings = VillageSetting::firstOrFail();

            $settings->update($data);

            Cache::forget($this->cacheKey);

            return $settings;
        });
    }

    public function updateLogo(UploadedFile $file): VillageSetting
    {
        return DB::transaction(function () use ($file) {
            $settings = VillageSetting::firstOrFail();

            if ($settings->village_logo && Storage::disk('public')->exists($settings->village_logo)) {
                Storage::disk('public')->delete($settings->village_logo);
            }

            $path = $file->store('village/logos', 'public');

            $settings->update([
                'village_logo' => $path
            ]);

            Cache::forget($this->cacheKey);

            return $settings;
        });
    }

    public function updateBanner(UploadedFile $file): VillageSetting
    {
        return DB::transaction(function () use ($file) {
            $settings = VillageSetting::firstOrFail();

            if ($settings->hero_image && Storage::disk('public')->exists($settings->hero_image)) {
                Storage::disk('public')->delete($settings->hero_image);
            }

            $path = $file->store('village/banners', 'public');

            $settings->update([
                'hero_image' => $path
            ]);

            Cache::forget($this->cacheKey);

            return $settings;
        });
    }
}
