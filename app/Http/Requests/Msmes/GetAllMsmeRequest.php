<?php

namespace App\Http\Requests\Msmes;

use Illuminate\Foundation\Http\FormRequest;

class GetAllMsmeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'            => ['nullable', 'string', 'max:255'],
            'business_category' => ['nullable', 'string', 'max:100'],
            'page'              => ['nullable', 'integer', 'min:1'],
        ];
    }


    public function attributes(): array
    {
        return [
            'search'            => 'Kata kunci pencarian',
            'business_category' => 'Kategori usaha',
        ];
    }
}
