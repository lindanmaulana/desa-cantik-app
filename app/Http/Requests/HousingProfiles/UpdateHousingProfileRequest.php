<?php

namespace App\Http\Requests\HousingProfiles;

use App\Enums\CookingFuel;
use App\Enums\ElectricityCapacity;
use App\Enums\ElectricitySource;
use App\Enums\FloorMaterial;
use App\Enums\HouseCondition;
use App\Enums\HouseOwnership;
use App\Enums\RoofMaterial;
use App\Enums\SanitationType;
use App\Enums\WallMaterial;
use App\Enums\WaterSource;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHousingProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'house_ownership' => ['required', Rule::enum(HouseOwnership::class)],
            'house_condition' => ['required', Rule::enum(HouseCondition::class)],
            'floor_material' => ['required', Rule::enum(FloorMaterial::class)],
            'wall_material' => ['required', Rule::enum(WallMaterial::class)],
            'roof_material' => ['required', Rule::enum(RoofMaterial::class)],
            'water_source' => ['required', Rule::enum(WaterSource::class)],
            'sanitation_type' => ['required', Rule::enum(SanitationType::class)],
            'cooking_fuel' => ['required', Rule::enum(CookingFuel::class)],
            'electricity_source' => ['required', Rule::enum(ElectricitySource::class)],
            'electricity_capacity' => ['required', Rule::enum(ElectricityCapacity::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'house_ownership.required' => 'Status kepemilikan rumah wajib dipilih.',
            'house_ownership.enum'     => 'Status kepemilikan rumah yang dipilih tidak valid.',

            'house_condition.required' => 'Kondisi rumah wajib dipilih.',
            'house_condition.enum'     => 'Kondisi rumah yang dipilih tidak valid.',

            'floor_material.required'  => 'Material lantai wajib dipilih.',
            'floor_material.enum'      => 'Material lantai yang dipilih tidak valid.',

            'wall_material.required'   => 'Material dinding wajib dipilih.',
            'wall_material.enum'       => 'Material dinding yang dipilih tidak valid.',

            'roof_material.required'   => 'Material atap wajib dipilih.',
            'roof_material.enum'       => 'Material atap yang dipilih tidak valid.',

            'water_source.required'    => 'Sumber air bersih wajib dipilih.',
            'water_source.enum'        => 'Sumber air bersih yang dipilih tidak valid.',

            'sanitation_type.required' => 'Jenis sanitasi wajib dipilih.',
            'sanitation_type.enum'     => 'Jenis sanitasi yang dipilih tidak valid.',

            'cooking_fuel.required'    => 'Bahan bakar memasak wajib dipilih.',
            'cooking_fuel.enum'        => 'Bahan bakar memasak yang dipilih tidak valid.',

            'electricity_source.required' => 'Sumber listrik wajib dipilih.',
            'electricity_source.enum'     => 'Sumber listrik yang dipilih tidak valid.',

            'electricity_capacity.required' => 'Daya listrik wajib dipilih.',
            'electricity_capacity.enum'     => 'Daya listrik yang dipilih tidak valid.',
        ];
    }
}
