<?php

namespace App\Http\Requests\Territories;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class getAllTerritoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    // $request->validate([
    //         'search' => 'nullable|string|max:255',
    //         'sub_village' => 'nullable|in:pahing,pon,wage',
    //     ]);

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:100'],
            'sub_village' => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'search.max' => 'Nama Dusun maksimal 100 karakter'
        ];
    }
}
