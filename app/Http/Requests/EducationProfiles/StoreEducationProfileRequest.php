<?php

namespace App\Http\Requests\EducationProfiles;

use App\Enums\EducationLevel;
use App\Enums\SchoolParticipation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class StoreEducationProfileRequest extends FormRequest
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
            'education_level' => ['required', Rule::enum(EducationLevel::class)],
            'highest_diploma' => ['required', Rule::enum(EducationLevel::class)],
            'school_participation' => ['required', Rule::enum(SchoolParticipation::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'education_level.required' => 'Jenjang pendidikan wajib dipilih.',
            'education_level.enum' => 'Jenjang pendidikan yang dipilih tidak valid.',

            'highest_diploma.required' => 'Ijazah tertinggi wajib dipilih.',
            'highest_diploma.enum' => 'Ijazah tertinggi yang dipilih tidak valid.',

            'school_participation.required' => 'Status sekolah wajib dipilih.',
            'school_participation.enum' => 'Status sekolah yang dipilih tidak valid.',
        ];
    }
}
