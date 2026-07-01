<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOperatorRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat request ini.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Aturan validasi untuk memperbarui data admin.
     */
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
                'in:operator',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
            ],
        ];
    }

    /**
     * Kustomisasi nama atribut untuk pesan error.
     */
    public function attributes(): array
    {
        return [
            'fullname' => 'Nama Lengkap Admin',
            'role'      => 'Peran/Hak Akses',
            'password'  => 'Kata Sandi',
        ];
    }
}
