<?php

namespace App\Http\Requests\Statistics;

use App\Enums\HealthType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HealthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', 'string', Rule::enum(HealthType::class)],
            'rw'   => ['nullable', 'string', 'max:5'],
            'rt'   => ['nullable', 'string', 'max:5'],
        ];
    }
}
