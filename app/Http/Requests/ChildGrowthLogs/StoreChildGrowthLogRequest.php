<?php

namespace App\Http\Requests\ChildGrowthLogs;

use App\Enums\MeasurementMethod;
use App\Enums\StuntingStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class StoreChildGrowthLogRequest extends FormRequest
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
            'measured_at' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'min:0'],
            'height' => ['required', 'numeric', 'min:0'],
            'measurement_method' => ['required', Rule::enum(MeasurementMethod::class)],
            'vit_a_received' => ['nullable', 'boolean'],
            'stunting_status' => ['required', Rule::enum(StuntingStatus::class)],
            'recorded_by' => ['nullable', 'exists:user,id'],
            'notes' => ['nullable', 'string', 'max:500']
        ];
    }

    public function messages()
    {
        return [
            'measured_at.required' => 'Tanggal pengukuran wajib diisi.',

            'weight.required' => 'Berat badan wajib diisi.',
            'weight.min' => 'Berat badan tidak boleh bernilai negatif.',

            'height.required' => 'Tinggi badan wajib diisi.',
            'height.min' => 'Tinggi badan tidak boleh bernilai negatif.',

            'measurement_method.required' => 'Metode pengukuran wajib dipilih.',
            'measurement_method.enum' => 'Metode pengukuran yang dipilih tidak valid.',

            'vit_a_received.boolean' => 'Pemberian vitamin A harus berupa pilihan ya/tidak.',

            'stunting_status.required' => 'Status stunting wajib dipilih.',
            'stunting_status.enum' => 'Status stunting yang dipilih tidak valid.',

            'notes.max' => 'Catatan tambahan maksimal 500 karakter.'
        ];
    }

}
