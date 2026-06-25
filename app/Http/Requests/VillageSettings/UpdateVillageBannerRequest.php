<?php

namespace App\Http\Requests\VillageSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVillageBannerRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'hero_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'image' => 'File :attribute harus berupa gambar.',
            'mimes' => 'Format gambar yang diperbolehkan adalah :values.',
            'max' => 'Ukuran :attribute tidak boleh lebih dari :max kilobita (4 MB).',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'hero_image' => 'Gambar Banner',
        ];
    }
}
