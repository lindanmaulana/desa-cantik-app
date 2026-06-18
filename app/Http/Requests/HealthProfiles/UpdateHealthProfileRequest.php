<?php

namespace App\Http\Requests\HealthProfiles;

use App\Enums\BpjsStatus;
use App\Enums\DisabilityType;
use App\Enums\Gender;
use App\Enums\KbMethod;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateHealthProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        $citizen = $this->route('citizen');

        return [
            'disability_type' => ['required', Rule::enum(DisabilityType::class)],
            'is_pregnant' => [
                'required',
                Rule::in([0, 1]),

                function ($attribute, $value, $fail) use ($citizen) {
                    if ($citizen && ($citizen->gender === Gender::MALE) && (int)$value == 1) {
                        $fail('Warga berjenis kelamin laki-laki tidak bisa berstatus sedang hamil.');
                    }
                }
            ],
            'kb_method' => ['required', Rule::enum(KbMethod::class)],
            'bpjs_status' => ['required', Rule::enum(BpjsStatus::class)],
        ];
    }


    public function messages(): array
    {
        return [
            'disability_type.required' => 'Jenis disabilitas wajib dipilih.',
            'disability_type.enum'     => 'Jenis disabilitas yang dipilih tidak valid.',

            'is_pregnant.required'     => 'Status kehamilan wajib dipilih.',
            'is_pregnant.boolean'      => 'Format status kehamilan harus berupa pilihan ya/tidak.',

            'kb_method.required'       => 'Metode KB wajib dipilih.',
            'kb_method.enum'           => 'Metode KB yang dipilih tidak valid.',

            'bpjs_status.required'     => 'Status kepesertaan BPJS wajib dipilih.',
            'bpjs_status.enum'         => 'Status kepesertaan BPJS yang dipilih tidak valid.',
        ];
    }
}
