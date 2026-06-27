<?php

namespace App\Http\Requests\Infrastructures;

use Illuminate\Foundation\Http\FormRequest;

class GetAllInfrastructureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search'        => ['nullable', 'string', 'max:255'],
            'facility_type' => ['nullable', 'string', 'max:100'],
            'condition'     => ['nullable', 'string', 'max:50'],
            'page'          => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function attributes(): array
    {
        return [
            'search'        => 'Kata kunci pencarian',
            'facility_type' => 'Jenis fasilitas',
            'condition'     => 'Kondisi aset',
        ];
    }
}
