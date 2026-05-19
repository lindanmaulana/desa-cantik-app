<?php

namespace App\Http\Requests\Infrastructures;

use App\Enums\ConditionInfrastructure;
use App\Enums\FacilityType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInfrastructureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentYear = date('Y');

        return [
            'facility_name' => ['required', 'string', 'max:255'],
            'facility_type' => [
                'required',
                'in:' . implode(',', array_column(FacilityType::cases(), 'value')),
            ],
            'condition' => [
                'nullable',
                'in:' . implode(',', array_column(ConditionInfrastructure::cases(), 'value')),
            ],
            'construction_year' => ['nullable', 'integer', 'min:1900', "max:{$currentYear}"],
            'funding_source' => ['required', 'string', 'max:100'],
        ];
    }

    /**
     * Localized Indonesian validation messages.
     */
    public function messages(): array
    {
        return [
            'facility_name.required' => 'Nama sarana prasarana wajib diisi.',
            'facility_name.max' => 'Nama sarana prasarana maksimal 255 karakter.',
            'facility_type.required' => 'Jenis fasilitas wajib dipilih.',
            'facility_type.in' => 'Jenis fasilitas yang dipilih tidak valid.',
            'condition.in' => 'Kondisi kelayakan fisik tidak valid.',
            'construction_year.integer' => 'Tahun pembangunan harus berupa angka bulat.',
            'construction_year.min' => 'Tahun pembangunan minimal tahun 1900.',
            'construction_year.max' => 'Tahun pembangunan tidak boleh melebihi tahun saat ini.',
            'funding_source.required' => 'Sumber pendanaan wajib diisi.',
            'funding_source.max' => 'Sumber pendanaan maksimal 100 karakter.',
        ];
    }
}
