<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:255', 'min:3'],
        ];
    }

    public function attributes(): array
    {
        return [
            'fullname' => 'Nama Lengkap',
        ];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => ':attribute wajib diisi.',
            'fullname.min' => ':attribute minimal berisi :min karakter.',
            'fullname.max' => ':attribute maksimal berisi :max karakter.',
        ];
    }
}
