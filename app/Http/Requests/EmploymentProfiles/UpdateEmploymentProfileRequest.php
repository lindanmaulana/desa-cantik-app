<?php

namespace App\Http\Requests\EmploymentProfiles;

use App\Enums\EconomicStatus;
use App\Enums\EmploymentStatus;
use App\Enums\JobSector;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmploymentProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'occupation' => ['required', 'string', 'max:100'],
            'job_sector' => ['required', Rule::enum(JobSector::class)],
            'employment_status' => ['required', Rule::enum(EmploymentStatus::class)],
            'monthly_income' => ['nullable', 'numeric', 'min:0'],
            'economic_status' => ['required', Rule::enum(EconomicStatus::class)],
            'is_welfare_recipient' => ['required', 'boolean'],
            'assistance_type' => ['nullable', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'occupation.required' => 'Pekerjaan utama wajib diisi.',
            'occupation.max' => 'Pekerjaan utama maksimal 100 karakter.',

            'job_sector.required' => 'Sektor pekerjaan wajib dipilih.',
            'job_sector.enum' => 'Sektor pekerjaan yang dipilih tidak valid.',

            'employment_status.required' => 'Status kerja wajib dipilih.',
            'employment_status.enum' => 'Status kerja yang dipilih tidak valid.',

            'monthly_income.numeric' => 'Pendapatan bulanan harus berupa angka.',
            'monthly_income.min' => 'Pendapatan bulanan tidak boleh bernilai negatif.',

            'economic_status.required' => 'Tingkat ekonomi wajib dipilih.',
            'economic_status.enum' => 'Tingkat ekonomi yang dipilih tidak valid.',

            'is_welfare_recipient.required' => 'Status penerima bansos wajib dipilih.',
            'is_welfare_recipient.boolean' => 'Format status penerima bansos harus berupa pilihan ya/tidak.',

            'assistance_type.max' => 'Jenis bantuan maksimal 255 karakter.'
        ];
    }
}
