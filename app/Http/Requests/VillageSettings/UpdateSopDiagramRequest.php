<?php

namespace App\Http\Requests\VillageSettings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSopDiagramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sop_diagram' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:8192'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Diagram SOP wajib dipilih.',
            'image' => 'File diagram harus berupa gambar.',
            'mimes' => 'Format diagram yang diperbolehkan adalah JPG, PNG, atau WEBP.',
            'max' => 'Ukuran diagram tidak boleh lebih dari 8 MB.',
        ];
    }
}
