<?php

namespace App\Http\Requests\Msmes;

use App\Enums\BusinessCategory;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMsmeRequest extends FormRequest
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
            'citizen_id' => [
                'required',
                'uuid',
                Rule::exists('citizens', 'id')->whereNull('deleted_at'),
            ],
            'business_name' => ['required', 'string', 'max:255'],
            'business_category' => [
                'required',
                'in:' . implode(',', array_column(BusinessCategory::cases(), 'value')),
            ],
            'license_number' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('msmes', 'license_number')->whereNull('deleted_at'),
            ],
            'employee_count' => ['required', 'integer', 'min:0'],
            'mothly_revenue' => ['nullable', 'numeric', 'min:0'],
        ];
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
            'mothly_revenue.numeric' => 'Omset bulanan harus berupa angka.',
            'mothly_revenue.min' => 'Omset bulanan minimal bernilai 0.',
        ];
    }
}
