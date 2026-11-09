<?php

namespace App\Http\Requests\Guestbook;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestbookEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_date' => ['required', 'date', 'after_or_equal:today'],
            'full_name' => ['required', 'string', 'max:150'],
            'address' => ['nullable', 'string', 'max:255'],
            'occupation' => ['nullable', 'string', 'max:100'],
            'institution' => ['nullable', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'purpose' => ['required', 'string', 'max:150'],
            'message' => ['nullable', 'string', 'max:2000'],
            'signature' => [
                'required',
                'string',
                'max:200000',
                'regex:/^data:image\/png;base64,[A-Za-z0-9+\/]+=*$/',
            ],
            'website' => ['prohibited'],
            'privacy_agreement' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'visit_date.required' => 'Tanggal kunjungan wajib dipilih.',
            'visit_date.after_or_equal' => 'Tanggal kunjungan tidak boleh sebelum hari ini.',
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'purpose.required' => 'Maksud atau tujuan kunjungan wajib diisi.',
            'signature.required' => 'Tanda tangan wajib dibuat.',
            'signature.regex' => 'Format tanda tangan tidak valid.',
            'privacy_agreement.accepted' => 'Persetujuan privasi wajib dicentang.',
            'website.prohibited' => 'Permintaan tidak valid.',
        ];
    }
}
