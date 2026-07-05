<?php

namespace App\Http\Requests\Territories;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTerritoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sub_village' => ['required', 'string', 'max:100'],
            'area_name' => ['string', 'max:100'],
            'rw' => ['required', 'string', 'regex:/^[0-9]{3}$/'],
            'rt' => ['required', 'string', 'regex:/^[0-9]{3}$/']
        ];
    }

    public function messages(): array
    {
        return [
            'sub_village.required' => 'Nama Dusun wajib diisi.',
            'sub_village.max' => 'Nama Dusun maksimal 100 karakter.',
            'area_name.max' => 'Nama Wilayah maksimal 100 karakter.',
            'rw.required'          => 'Nomor RW wajib diisi.',
            'rt.required'          => 'Nomor RT wajib diisi.',
        ];
    }
}
