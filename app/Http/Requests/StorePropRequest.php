<?php

namespace App\Http\Requests;

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
            'propFtpHost' => ['required', 'min:1', 'max:100'],
            'propFtpUsername' => ['required', 'min:1', 'max:100'],
            'propFtpPassword' => ['required', 'min:1', 'max:100'],
            'propFtpRoot' => ['required', 'min:1', 'max:100'],
            'propFtpPort' => ['required', 'min:0', 'max:100', 'integer'],
            'propImportLimit' => ['required', 'min:0', 'max:100', 'integer'],
            'propImportSleep' => ['required', 'min:0', 'max:10', 'integer'],
            'propImportRedirect' => ['required', 'min:0', 'max:1', 'integer'],
            'propImportSeparate' => ['required', 'min:0', 'max:1', 'integer'],
            'propRecorderFreq' => ['required', 'min:1', 'max:5000', 'numeric'],
            'propRecorderThreshold' => ['required', 'min:1', 'max:100', 'integer'],
            'propRecorderDelayPause' => ['required', 'min:1', 'max:10', 'integer'],
            'propRecorderDelayStop' => ['required', 'min:1', 'max:100', 'integer'],
            'propRecorderMinDuration' => ['required', 'min:0', 'max:100', 'integer'],
            'propRecorderMaxDuration' => ['required', 'min:10', 'max:1000', 'integer'],
            'propRecorderPlay' => ['required', 'min:0', 'max:1', 'integer'],
            'propAppMode' => ['required', 'min:0', 'max:1', 'integer'],
            'propAppRegister' => ['required', 'min:0', 'max:1', 'integer'],
        ];
    }
}
