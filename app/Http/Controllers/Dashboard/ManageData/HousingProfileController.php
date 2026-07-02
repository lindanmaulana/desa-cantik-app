<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Http\Requests\HousingProfiles\StoreHousingProfileRequest;
use App\Http\Requests\HousingProfiles\UpdateHousingProfileRequest;
use App\Models\Family;
use App\Services\ManageData\HousingProfileService;
use Exception;

class HousingProfileController extends Controller
{
    public function __construct(protected HousingProfileService $housingProfileService) {}

    public function store(StoreHousingProfileRequest $request, Family $family)
    {
        $validated = $request->validated();

        try {
            $this->housingProfileService->store($validated, $family);
            return redirect()->back()->with('success', 'Profil rumah dan hunian keluarga berhasil disimpan.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function update(UpdateHousingProfileRequest $request, Family $family)
    {
        $validated = $request->validated();

        try {
            $updated = $this->housingProfileService->update($validated, $family);

            if (!$updated) {
                return redirect()->back()->with('error', 'Profil rumah tidak ditemukan.');
            }

            return redirect()->back()->with('success', 'Profil rumah dan hunian keluarga berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }
}

