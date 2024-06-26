<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeyValueRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'key' => 'required|string',
            'value' => 'required|string',
        ];
    }

    /**
     * Extract input key-value pair into key and value for validation
     */
    public function prepareForValidation()
    {
        $input = $this->all();
        $key = key($input);
        $value = $input[$key];

        $this->merge([
            'key' => $key,
            'value' => $value,
        ]);
    }
}
