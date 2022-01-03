<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExportDataRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'type' => [
                'bail',
                'required',
                'string',
                Rule::in(['all', 'region', 'municipality'])
            ],
            'id' => [
                'bail',
                'required_unless:type,all',
                'numeric',
                Rule::when($this->request->get('type') === 'region', ['between:1,12']),
                Rule::when($this->request->get('type') === 'municipality', ['between:1,212']),
            ],
        ];
    }
}
