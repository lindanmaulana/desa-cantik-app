<?php

namespace App\Http\Requests\Citizens;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
use App\Http\Requests\EducationProfiles\UpdateEducationProfileRequest;
use App\Http\Requests\EmploymentProfiles\UpdateEmploymentProfileRequest;
use App\Http\Requests\HealthProfiles\UpdateHealthProfileRequest;
use App\Http\Requests\HousingProfiles\UpdateHousingProfileRequest;

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
            'family_role' => ['required', 'in:' . implode(',', array_column(FamilyRole::cases(), 'value'))],
            'gender' => ['required', 'in:' . implode(',', array_column(Gender::cases(), 'value'))],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'religion' => ['required', 'in:' . implode(',', array_column(Religion::cases(), 'value'))],
            'marital_status' => ['required', 'in:' . implode(',', array_column(MaritalStatus::cases(), 'value'))],
            'blood_type' => ['nullable', 'string', 'max:5'],
        ];

        return $citizenRules;

        // $educationRules = (new UpdateEducationProfileRequest())->rules();
        // $employmentRules = (new UpdateEmploymentProfileRequest())->rules();
        // $healthRules     = (new UpdateHealthProfileRequest())->rules();
        // $housingRules    = (new UpdateHousingProfileRequest())->rules();

        // return array_merge(
        //     $citizenRules,
        //     $educationRules,
        //     $employmentRules,
        //     $healthRules,
        //     $housingRules,
        // );
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
            'family_role.in' => 'Peran dalam keluarga tidak valid',
            'gender.required' => 'Jenis kelamin wajib diisi',
            'gender.in' => 'Jenis kelamin tidak valid',
            'birth_place.required' => 'Tempat lahir wajib diisi',
            'birth_place.max' => 'Tempat lahir maksimal 255 karakter',
            'birth_date.date' => 'Tanggal lahir tidak valid',
            'religion.required' => 'Agama wajib diisi',
            'religion.in' => 'Agama tidak valid',
            'marital_status.required' => 'Status pernikahan wajib diisi',
            'marital_status.in' => 'Status pernikahan tidak valid',
            'blood_type.max' => 'Golongan darah maksimal 5 karakter',
        ];
    }
}
