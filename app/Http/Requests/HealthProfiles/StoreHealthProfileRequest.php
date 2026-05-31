<?php

namespace App\Http\Requests\HealthProfiles;

use App\Enums\BpjsStatus;
use App\Enums\DisabilityType;
use App\Enums\KbMethod;
use App\Models\Citizen;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreHealthProfileRequest extends FormRequest
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
            'disability_type' => ['required', Rule::enum(DisabilityType::class)],
            'is_pregnant' => ['required', 'boolean'],
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
