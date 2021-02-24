<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ExportFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape([
        'type' => "string",
        'id' => "string"
    ])]
    public function rules(): array
    {
        return [
            'type' => 'bail|required|string|in:regions,municipalities,all',
            'id' => 'bail|required_unless:type,all|integer|between:1,212'
        ];
    }
}
