<?php

namespace App\Http\Requests\Families;

use Illuminate\Foundation\Http\FormRequest;

class GetAllFamilyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'       => ['nullable', 'string', 'max:255'],
            'territory_id' => ['nullable', 'exists:territories,id'],
            'page'         => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'search'       => 'Kata kunci pencarian',
            'territory_id' => 'Wilayah/RT/RW',
        ];
    }
}
