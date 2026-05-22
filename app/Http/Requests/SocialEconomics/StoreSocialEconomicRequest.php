<?php

namespace App\Http\Requests\SocialEconomics;

use App\Enums\EconomicStatus;
use App\Enums\EducationLevel;
use App\Enums\HouseCondition;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSocialEconomicRequest extends FormRequest
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
            'citizen_id' => [
                'required',
                'uuid',
                Rule::exists('citizens', 'id')->whereNull('deleted_at'),
                Rule::unique('social_economics', 'citizen_id')->whereNull('deleted_at'),
            ],
            'education_level' => [
                'required',
                'in:' . implode(',', array_column(EducationLevel::cases(), 'value')),
            ],
            'occupation' => ['required', 'string', 'max:100'],
            'monthly_income' => ['nullable', 'numeric', 'min:0'],
            'is_welfare_recipient' => ['required', 'boolean'],
            'assistance_type' => ['required_if:is_welfare_recipient,1', 'nullable', 'string', 'max:255'],
            'house_condition' => [
                'required',
                'in:' . implode(',', array_column(HouseCondition::cases(), 'value')),
            ],
            'economic_status' => [
                'required',
                'in:' . implode(',', array_column(EconomicStatus::cases(), 'value')),
            ],
        ];
    }

    /**
     * Localized Indonesian validation messages.
     */
    public function messages(): array
    {
        return [
            'citizen_id.required' => 'Penduduk wajib dipilih.',
            'citizen_id.exists' => 'Data penduduk yang dipilih tidak valid atau telah dihapus.',
            'citizen_id.unique' => 'Penduduk yang dipilih sudah memiliki profil sosial ekonomi.',
            'education_level.required' => 'Tingkat pendidikan wajib dipilih.',
            'education_level.in' => 'Tingkat pendidikan yang dipilih tidak valid.',
            'occupation.required' => 'Jenis pekerjaan wajib diisi.',
            'occupation.max' => 'Jenis pekerjaan maksimal 100 karakter.',
            'monthly_income.numeric' => 'Estimasi pendapatan harus berupa angka.',
            'monthly_income.min' => 'Estimasi pendapatan minimal bernilai 0.',
            'is_welfare_recipient.required' => 'Status penerima bansos wajib dipilih.',
            'assistance_type.required_if' => 'Jenis bantuan wajib diisi jika berstatus penerima bansos.',
            'assistance_type.max' => 'Jenis bantuan maksimal 255 karakter.',
            'house_condition.required' => 'Kelayakan tempat tinggal wajib dipilih.',
            'house_condition.in' => 'Kelayakan tempat tinggal yang dipilih tidak valid.',
            'economic_status.required' => 'Tingkat ekonomi wajib dipilih.',
            'economic_status.in' => 'Tingkat ekonomi yang dipilih tidak valid.',
        ];
    }
}
