<?php

namespace App\Http\Controllers\Dashboard\ManageData;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\HousingProfile;
use Illuminate\Http\Request;

class HousingProfileController extends Controller
{

    public function store(Request $request, Family $family)
    {
        $validated = $request->validate([
            'floor_area_per_capita' => 'required|in:less_than_8_sqm,greater_equal_8_sqm',
            'floor_material'        => 'required|in:high_quality_floor,low_quality_floor,dirt_bamboo',
            'wall_material'         => 'required|in:masonry_high_quality,wood_low_quality,bamboo_thatch',
            'water_source'          => 'required|in:bottled_refill,piped_pdam,protected_well,unprotected_well,spring_water,river_rainwater',
            'sanitation_type'       => 'required|in:private_flush_toilet,shared_flush_toilet,pit_latrine,no_toilet',
            'cooking_fuel'          => 'required|in:electricity,lpg_gas,kerosene,biogas,wood_charcoal',
            'electricity_source'    => 'required|in:pln_metered,pln_unmetered,non_pln,no_electricity',
            'electricity_capacity'  => 'required|in:non_electricity,450va,900va,1300va,2200va,above_2200va',
        ]);

        $family->housingProfile()->create($validated);

        return redirect()->back()->with('success', 'Profil rumah dan hunian keluarga berhasil disimpan.');
    }

    public function update(Request $request, Family $family, HousingProfile $housingProfile)
    {
        $validated = $request->validate([
            'floor_area_per_capita' => 'required|in:less_than_8_sqm,greater_equal_8_sqm',
            'floor_material'        => 'required|in:high_quality_floor,low_quality_floor,dirt_bamboo',
            'wall_material'         => 'required|in:masonry_high_quality,wood_low_quality,bamboo_thatch',
            'water_source'          => 'required|in:bottled_refill,piped_pdam,protected_well,unprotected_well,spring_water,river_rainwater',
            'sanitation_type'       => 'required|in:private_flush_toilet,shared_flush_toilet,pit_latrine,no_toilet',
            'cooking_fuel'          => 'required|in:electricity,lpg_gas,kerosene,biogas,wood_charcoal',
            'electricity_source'    => 'required|in:pln_metered,pln_unmetered,non_pln,no_electricity',
            'electricity_capacity'  => 'required|in:non_electricity,450va,900va,1300va,2200va,above_2200va',
        ]);

        $housingProfile->update($validated);

        return redirect()->back()->with('success', 'Profil rumah dan hunian keluarga berhasil diperbarui.');
    }
}
