<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat request ini.
     * Kita set true karena proteksi role sudah ditangani oleh Middleware di Route.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk request ini.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'uuid',
                'exists:citizens,id',       // Harus ada di tabel warga (citizens)
                'unique:users,username',    // Warga tersebut belum punya akun user lain
            ],
            'full_name' => [
                'required',
                'string',
                'max:255',
            ],
            'role' => [
                'required',
                'string',
                'in:admin,operator,head_of_rw,head_of_rt', // Sesuai opsi ENUM skema Anda
            ],
            'territory_id' => [
                'nullable',
                'uuid',
                'exists:territories,id',    // Jika diisi, harus valid ada di tabel wilayah
            ],
            'password' => [
                'nullable',                 // Boleh kosong karena ada default 'resident'
                'string',
                'min:8',
            ],
        ];
    }

    /**
     * Kustomisasi nama atribut untuk pesan error yang lebih user-friendly.
     */
    public function attributes(): array
    {
        return [
            'username'     => 'Data Warga',
            'full_name'    => 'Nama Lengkap',
            'role'         => 'Peran/Hak Akses',
            'territory_id' => 'Wilayah Tugas',
            'password'     => 'Kata Sandi',
        ];
    }
}
