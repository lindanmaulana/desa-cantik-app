<?php

namespace App\Http\Requests\Citizens;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\FamilyRole;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;

class StoreCitizenRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
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
    }

    public function messages(): array {
        return [
            'full_name.required' => 'Nama lengkap wajib diisi',
            'full_name.max' => 'Nama lengkap maksimal 255 karakter',
            'id_number.required' => 'Nomor KTP wajib diisi',
            'id_number.max' => 'Nomor KTP maksimal 16 karakter',
            'family_role.required' => 'Status dalam keluarga wajib diisi',
            'gender.required' => 'Jenis kelamin wajib diisi',
            'birth_place.required' => 'Tempat lahir wajib diisi',
            'birth_place.max' => 'Tempat lahir maksimal 255 karakter',
            'marital_status.required' => 'Status pernikahan wajib diisi',
            'religion.required' => 'Agama wajib diisi',
            'blood_type.max' => 'Golongan darah maksimal 5 karakter',
        ];
    }
}
