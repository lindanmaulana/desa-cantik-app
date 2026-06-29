<?php

namespace App\Http\Requests\Citizens;

use Illuminate\Foundation\Http\FormRequest;

class GetAllCitizenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'         => 'nullable|string|max:255',
            'gender'         => 'nullable|string|in:male,female',
            'religion'       => 'nullable|string',
            'marital_status' => 'nullable|string',
            'family_id'      => 'nullable|exists:families,id',
        ];
    }

    public function messages(): array
    {
        return [
            'search.max'       => 'Pencarian tidak boleh lebih dari 255 karakter.',
            'gender.in'        => 'Jenis kelamin yang dipilih harus laki-laki atau perempuan.',
            'family_id.exists' => 'Keluarga yang dipilih tidak valid atau tidak terdaftar.',
        ];
    }
}
