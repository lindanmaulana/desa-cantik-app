<?php

namespace App\Http\Requests\SpatialData;

use App\Enums\FeatureType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSpatialDataRequest extends FormRequest
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
            'feature_type' => [
                'required',
                'in:' . implode(',', array_column(FeatureType::cases(), 'value')),
            ],
            'feature_id' => [
                'required',
                'uuid',
                function ($attribute, $value, $fail) {
                    $type = $this->input('feature_type');
                    if ($type === 'resident_house') {
                        if (!\App\Models\Citizen::where('id', $value)->exists()) {
                            $fail('Data warga/penduduk yang Anda pilih tidak valid atau tidak ditemukan.');
                        }
                    } elseif ($type === 'public_facility') {
                        if (!\App\Models\Infrastructure::where('id', $value)->exists()) {
                            $fail('Data infrastruktur fisik yang Anda pilih tidak valid atau tidak ditemukan.');
                        }
                    } elseif ($type === 'msme_location') {
                        if (!\App\Models\Msmes::where('id', $value)->exists()) {
                            $fail('Data unit usaha UMKM yang Anda pilih tidak valid atau tidak ditemukan.');
                        }
                    }
                }
            ],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longtitude' => ['required', 'numeric', 'between:-180,180'],
            'geojson' => ['nullable', 'string'],
        ];
    }

    /**
     * Localized Indonesian validation messages.
     */
    public function messages(): array
    {
        return [
            'feature_type.required' => 'Jenis objek geografis wajib dipilih.',
            'feature_type.in' => 'Jenis objek geografis yang dipilih tidak valid.',
            'feature_id.required' => 'Identitas objek asal wajib dipilih.',
            'feature_id.uuid' => 'ID objek asal harus berupa UUID yang valid.',
            'latitude.required' => 'Koordinat garis lintang (latitude) wajib diisi.',
            'latitude.numeric' => 'Garis lintang harus berupa angka koordinat.',
            'latitude.between' => 'Garis lintang harus bernilai antara -90 sampai 90 derajat.',
            'longtitude.required' => 'Koordinat garis bujur (longitude) wajib diisi.',
            'longtitude.numeric' => 'Garis bujur harus berupa angka koordinat.',
            'longtitude.between' => 'Garis bujur harus bernilai antara -180 sampai 180 derajat.',
        ];
    }
}
