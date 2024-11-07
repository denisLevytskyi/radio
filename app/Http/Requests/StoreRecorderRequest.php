<?php

namespace App\Http\Requests;

use App\Rules\FreqPrecision;
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
            'recorderFreq' => ['required', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            'recorderFile' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        abort(404);
    }
}
