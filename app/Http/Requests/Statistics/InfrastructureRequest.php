<?php

namespace App\Http\Requests\Statistics;

use App\Enums\InfrastructureType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InfrastructureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', Rule::enum(InfrastructureType::class)],
            'rw'   => ['nullable', 'string', 'max:5'],
            'rt'   => ['nullable', 'string', 'max:5'],
        ];
    }
}
