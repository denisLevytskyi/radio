<?php

namespace App\Http\Requests;

use App\Rules\FreqPrecision;
use Illuminate\Foundation\Http\FormRequest;

class StorePropRequest extends FormRequest
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
            'propRecorderFreq' => ['required', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            'propRecorderThreshold' => ['required', 'min:1', 'max:100', 'integer'],
            'propRecorderDelayPause' => ['required', 'min:1', 'max:10', 'integer'],
            'propRecorderDelayStop' => ['required', 'min:1', 'max:100', 'integer'],
            'propRecorderMinDuration' => ['required', 'min:0', 'max:100', 'integer'],
            'propRecorderMaxDuration' => ['required', 'min:10', 'max:1000', 'integer'],
            'propRecorderPlay' => ['required', 'min:0', 'max:1', 'integer'],
            'propRecorderFile' => ['required', 'min:0', 'max:1', 'integer'],
            'propAppMode' => ['required', 'min:0', 'max:1', 'integer'],
            'propAppRegister' => ['required', 'min:0', 'max:1', 'integer'],
            'propAppPaginator' => ['required', 'min:1', 'max:100', 'integer'],
        ];
    }
}
