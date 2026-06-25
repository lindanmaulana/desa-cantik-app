<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\VillageSettings\StoreVillageSettingRequest;
use App\Http\Requests\VillageSettings\UpdateVillageSettingRequest;
use App\Http\Requests\VillageSettings\UpdateVillageLogoRequest;
use App\Http\Requests\VillageSettings\UpdateVillageBannerRequest;
use App\Services\Settings\VillageSettingService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VillageSettingController extends Controller
{
    public function __construct(protected VillageSettingService $villageSettingService) {}

    public function index()
    {
        $settings = $this->villageSettingService->getSettings();

        return view('dashboard.settings.index', compact('settings'));
    }

    public function store(StoreVillageSettingRequest $request)
    {
        if ($this->villageSettingService->getSettings()) {
            return redirect()->back()->with('error', 'Pengaturan desa sudah ada.');
        }

        $validated = $request->validated();

        try {
            $this->villageSettingService->storeSettings($validated);

            return redirect()->back()->with('success', 'Pengaturan desa berhasil disimpan.');
        } catch (\Throwable $err) {
            Log::error('Gagal menyimpan data pengaturan desa: ' . $err->getMessage(), [
                'user_id' => Auth::id(),
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function update(UpdateVillageSettingRequest $request)
    {
        $validated = $request->validated();

        try {
            $this->villageSettingService->updateSettings($validated);

            return redirect()->back()->with('success', 'Pengaturan desa berhasil diperbarui.');
        } catch (\Throwable $err) {
            Log::error('Gagal memperbarui data pengaturan desa: ' . $err->getMessage(), [
                'user_id' => Auth::id(),
                'payload' => $request->all(),
                'trace'   => $err->getTraceAsString()
            ]);

            return back()->withInput()->with('error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
        }
    }

    public function updateLogo(UpdateVillageLogoRequest $request)
    {
        try {
            $file = $request->file('village_logo');
            $this->villageSettingService->updateLogo($file);

            return redirect()->back()->with('success', 'Logo resmi desa berhasil diperbarui.');
        } catch (\Throwable $err) {
            Log::error('Gagal memperbarui logo desa: ' . $err->getMessage(), [
                'user_id' => Auth::id(),
                'trace'   => $err->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Gagal memperbarui logo. Silakan coba lagi.');
        }
    }

    public function updateBanner(UpdateVillageBannerRequest $request)
    {
        try {
            $file = $request->file('hero_image');
            $this->villageSettingService->updateBanner($file);

            return redirect()->back()->with('success', 'Banner utama berhasil diperbarui.');
        } catch (\Throwable $err) {
            Log::error('Gagal memperbarui banner desa: ' . $err->getMessage(), [
                'user_id' => Auth::id(),
                'trace'   => $err->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Gagal memperbarui banner. Silakan coba lagi.');
        }
    }
}
