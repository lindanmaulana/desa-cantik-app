<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password'],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(8)->letters()->numbers()
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => 'Kata Sandi Saat Ini',
            'password' => 'Kata Sandi Baru',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => ':attribute wajib diisi.',
            'current_password.current_password' => ':attribute yang Anda masukkan salah.',
            'password.required' => ':attribute wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'password.min' => ':attribute minimal harus berisi :min karakter.',
        ];
    }
}
