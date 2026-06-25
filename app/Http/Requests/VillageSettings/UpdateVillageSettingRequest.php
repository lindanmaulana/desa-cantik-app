<?php

namespace App\Http\Requests\VillageSettings;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVillageSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'village_name' => ['sometimes', 'required', 'string', 'max:100'],
            'village_code' => ['sometimes', 'required', 'string', 'max:20'],
            'subdistrict_name' => ['sometimes', 'required', 'string', 'max:100'],
            'regency_name' => ['sometimes', 'required', 'string', 'max:100'],
            'province_name' => ['sometimes', 'required', 'string', 'max:100'],

            'village_head_name' => ['nullable', 'string', 'max:150'],
            'village_head_nip' => ['nullable', 'string', 'max:30'],

            'app_title' => ['sometimes', 'required', 'string', 'max:100'],

            'village_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'hero_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:4096'],

            'office_address' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'official_email' => ['nullable', 'email', 'max:100'],
            'phone_number' => ['nullable', 'string', 'max:20'],

            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],

            'facebook_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute maksimal berisi :max karakter.',
            'image' => 'File harus berupa gambar.',
            'mimes' => 'Format gambar yang diperbolehkan adalah :values.',
            'email' => 'Format email tidak valid.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'between' => 'Nilai :attribute harus berada di antara :min dan :max.',
            'url' => 'Format tautan :attribute tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'village_name' => 'Nama Desa',
            'village_code' => 'Kode Desa',
            'subdistrict_name' => 'Kecamatan',
            'regency_name' => 'Kabupaten/Kota',
            'province_name' => 'Provinsi',
            'village_head_name' => 'Nama Kepala Desa',
            'village_head_nip' => 'NIP Kepala Desa',
            'app_title' => 'Judul Aplikasi',
            'village_logo' => 'Logo Desa',
            'hero_image' => 'Gambar Banner',
            'office_address' => 'Alamat Kantor',
            'postal_code' => 'Kode Pos',
            'official_email' => 'Email Resmi',
            'phone_number' => 'Nomor Telepon',
            'latitude' => 'Garis Lintang (Latitude)',
            'longitude' => 'Garis Bujur (Longitude)',
            'facebook_url' => 'Tautan Facebook',
            'youtube_url' => 'Tautan YouTube',
            'instagram_url' => 'Tautan Instagram',
        ];
    }
}
