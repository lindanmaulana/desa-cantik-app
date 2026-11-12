<?php

namespace App\Http\Requests\Publication;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'document_number' => ['nullable', 'string', 'max:100'],
            'category' => ['required', 'in:profil-desa,monografi-desa,infografis,publikasi,metadata-statistik'],
            'year' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:draft,published,archived'],
            'file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp', 'max:20480'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }
}
