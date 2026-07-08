<?php

namespace App\Http\Requests\Citizens;

use App\Enums\BloodType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;

class UpdateCitizenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $citizenRules =  [
            'family_id' => ['required', Rule::exists('families', 'id')],
            'id_number' => ['required', 'string', 'max:16'],
            'full_name' => ['required', 'string', 'max:255'],
            'family_role' => ['required', Rule::enum(FamilyRole::class)],
            'gender' => ['required', Rule::enum(Gender::class)],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'religion' => ['required', Rule::enum(Religion::class)],
            'marital_status' => ['required', Rule::enum(MaritalStatus::class)],
            'blood_type' => ['nullable', Rule::enum(BloodType::class)],
        ];

        return $citizenRules;
    }

    public function messages(): array
    {
        return [
            'family_id.required' => 'Keluarga wajib diisi',
            'family_id.exists' => 'Keluarga tidak ditemukan',

            'id_number.required' => 'Nomor Induk Kependudukan wajib diisi',
            'id_number.max' => 'Nomor Induk Kependudukan maksimal 16 karakter',

            'full_name.required' => 'Nama lengkap wajib diisi',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter',

            'family_role.required' => 'Peran dalam keluarga wajib diisi',
            'family_role.enum' => 'Peran dalam keluarga tidak valid',

            'gender.required' => 'Jenis kelamin wajib diisi',
            'gender.enum' => 'Jenis kelamin tidak valid',

            'birth_place.required' => 'Tempat lahir wajib diisi',
            'birth_place.max' => 'Tempat lahir maksimal 255 karakter',

            'birth_date.date' => 'Tanggal lahir tidak valid',

            'religion.required' => 'Agama wajib diisi',
            'religion.enum' => 'Agama tidak valid',

            'marital_status.required' => 'Status pernikahan wajib diisi',
            'marital_status.enum' => 'Status pernikahan tidak valid',

            'blood_type.enum' => 'Golongan darah tidak valid',
        ];
    }
}
