<?php

namespace App\Http\Requests\Msmes;

use App\Enums\BumdesPartnershipStatus;
use App\Enums\BusinessCategory;
use App\Enums\CapitalSource;
use App\Enums\DigitalPlatformType;
use App\Enums\LegalEntityType;
use App\Models\Msme;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Msmes;

class UpdateMsmeRequest extends FormRequest
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
        $msme = $this->route('msme');
        $id = $msme instanceof Msme ? $msme->id : $msme;

        return [
            'citizen_id' => [
                'required',
                'uuid',
                Rule::exists('citizens', 'id')->whereNull('deleted_at'),
            ],
            'business_name' => ['required', 'string', 'max:255'],
            'business_category' => [
                'required', Rule::enum(BusinessCategory::class)],
            'license_number' => ['nullable', 'string', 'max:100', Rule::unique('msmes', 'license_number')->ignore($id)->whereNull('deleted_at')],
            'employee_count' => ['required', 'integer', 'min:0'],
            'monthly_revenue' => ['nullable', 'numeric', 'min:0'],
            'legal_entity_type' => ['required', Rule::enum(LegalEntityType::class)],
            'uses_digital_payment' => ['nullable', 'boolean'],
            'digita_platform_type' => ['required', Rule::enum(DigitalPlatformType::class)],
            'capital_source' => ['required', Rule::enum(CapitalSource::class)],
            'is_environmentally_friendly' => ['nullable', 'boolean'],
            'bumdes_partnership_status' => ['required', Rule::enum(BumdesPartnershipStatus::class)],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'uses_digital_payment' => $this->has('uses_digital_payment') ? 1 : 0,
            'is_environmentally_friendly' => $this->has('is_environmentally_friendly') ? 1 : 0,
            'monthly_revenue' => $this->filled('monthly_revenue') ? $this->input('monthly_revenue') : 0,
        ]);
    }

    /**
     * Localized Indonesian validation messages.
     */
    public function messages(): array
    {
        return [
            'citizen_id.required' => 'Pemilik usaha (warga) wajib dipilih.',
            'citizen_id.exists' => 'Data pemilik usaha tidak valid atau telah dihapus.',
            'business_name.required' => 'Nama usaha wajib diisi.',
            'business_name.max' => 'Nama usaha maksimal 255 karakter.',
            'business_category.required' => 'Kategori usaha wajib dipilih.',
            'business_category.in' => 'Kategori usaha yang dipilih tidak valid.',
            'license_number.max' => 'Nomor izin usaha (NIB) maksimal 100 karakter.',
            'license_number.unique' => 'Nomor izin usaha (NIB) sudah terdaftar di database.',
            'employee_count.required' => 'Jumlah tenaga kerja wajib diisi.',
            'employee_count.integer' => 'Jumlah tenaga kerja harus berupa angka bulat.',
            'employee_count.min' => 'Jumlah tenaga kerja minimal bernilai 0.',
            'monthly_revenue.numeric' => 'Omset bulanan harus berupa angka.',
            'monthly_revenue.min' => 'Omset bulanan tidak boleh bernilai negatif.',
            'legal_entity_type.required' => 'Status badan hukum usaha wajib dipilih.',
            'digita_platform_type.required' => 'Penggunaan platform digital wajib ditentukan.',
            'capital_source.required' => 'Sumber modal usaha wajib dipilih.',
            'bumdes_partnership_status.required' => 'Status kemitraan BUM Desa wajib dipilih.',
        ];
    }
}
