<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ColorSchemeRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'scheme' => [
                Rule::in(['dark', 'light'])],
                'string'
        ];
    }

    public function messages(): array
    {
        return [
            'scheme.required' => 'Setting is required'
        ];
    }
}
