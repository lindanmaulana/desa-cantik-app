<?php

namespace App\Http\Requests\Families;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFamilyRequest extends FormRequest
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
        $familyId = $this->route('family')?->id ?? $this->route('family');

        return [
            'territory_id' => ['required', 'exists:territories,id'],
            'family_card_number' => ['required', 'numeric', 'digits:16', Rule::unique('families', 'family_card_number')->ignore($familyId)],
            'address_detail' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'territory_id.required' => 'Wilayah wajib diisi',
            'territory_id.exists'         => 'Wilayah yang dipilih tidak valid.',
            'family_card_number.required' => 'Nomor Kartu Keluarga wajib diisi',
            'family_card_number.numeric'  => 'Nomor Kartu Keluarga harus berupa angka.',
            'family_card_number.digits'   => 'Nomor Kartu Keluarga harus tepat 16 digit.',
            'family_card_number.unique'   => 'Nomor Kartu Keluarga sudah terdaftar di sistem.',
            'family_card_number.max' => 'Nomor Kartu Keluarga maksimal 16 karakter',
        ];
    }
}
