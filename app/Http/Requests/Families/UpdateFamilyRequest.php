<?php

namespace App\Http\Requests\Families;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFamilyRequest extends FormRequest
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
      'territory_id' => ['required', 'exists:territories,id'],
      'family_card_number' => ['required', 'string', 'max:16'],
      'address_detail' => ['string'],
    ];
  }

  public function messages(): array
  {
    return [
      'territory_id.required' => 'Wilayah wajib diisi',
      'family_card_number.required' => 'Nomor Kartu Keluarga wajib diisi',
      'family_card_number.max' => 'Nomor Kartu Keluarga maksimal 16 karakter',
    ];
  }
}
