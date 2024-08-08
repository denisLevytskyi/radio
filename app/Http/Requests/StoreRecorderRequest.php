<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRecorderRequest extends FormRequest
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
            'recorderFreq' => ['required', 'min:1', 'max:5000', 'numeric'],
            'recorderFile' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response('',404);
        throw new HttpResponseException($response);
    }
}
