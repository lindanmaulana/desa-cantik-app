<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => [
                'required',
                'string',
                'max:255',
            ],
            'role' => [
                'required',
                'string',
                'in:admin',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'fullname' => 'Nama Lengkap Admin',
            'role'      => 'Peran/Hak Akses',
            'password'  => 'Kata Sandi',
        ];
    }
}
