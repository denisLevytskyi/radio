<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreNfcCardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'loginPin' => ['required', 'min:1000', 'max:9999', 'integer'],
            'loginToken' => ['required', 'min:100', 'max:1000'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        abort(404);
    }
}
