<?php

namespace App\Http\Requests\Statistics;

use App\Enums\SocialType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SocialRequest extends FormRequest
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
            'type' => ['nullable', 'string', Rule::enum(SocialType::class)],
            'rw'   => ['nullable', 'string', 'max:5'],
            'rt'   => ['nullable', 'string', 'max:5'],
        ];
    }
}
