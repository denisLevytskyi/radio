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
            'propSelfPath' => ['required', 'min:1', 'max:100'],
            'propFtpHost' => ['required', 'min:1', 'max:100'],
            'propFtpUsername' => ['required', 'min:1', 'max:100'],
            'propFtpPassword' => ['required', 'min:1', 'max:100'],
            'propFtpRoot' => ['required', 'min:1', 'max:100'],
            'propFtpPort' => ['required', 'min:1', 'max:100', 'integer'],
            'propFtpPassive' => ['required', 'min:0', 'max:1', 'integer'],
            'propFtpTimeout' => ['required', 'min:1', 'max:100', 'integer'],
            'propTempPath' => ['required', 'min:1', 'max:100'],
            'propOutHost' => ['required', 'min:1', 'max:100'],
            'propOutUsername' => ['required', 'min:1', 'max:100'],
            'propOutPassword' => ['required', 'min:1', 'max:100'],
            'propOutRoot' => ['required', 'min:1', 'max:100'],
            'propOutPort' => ['required', 'min:1', 'max:100', 'integer'],
            'propOutPassive' => ['required', 'min:0', 'max:1', 'integer'],
            'propOutTimeout' => ['required', 'min:1', 'max:100', 'integer'],
            'propImportDisk' => ['required', 'min:0', 'max:1', 'integer'],
            'propImportLimit' => ['required', 'min:0', 'max:100', 'integer'],
            'propImportSleep' => ['required', 'min:0', 'max:10', 'integer'],
            'propImportRedirect' => ['required', 'min:0', 'max:1', 'integer'],
            'propImportSeparate' => ['required', 'min:0', 'max:1', 'integer'],
            'propImporterDelay' => ['required', 'min:1', 'max:5000', 'integer'],
            'propRecorderFreq' => ['required', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            'propRecorderThreshold' => ['required', 'min:1', 'max:100', 'integer'],
            'propRecorderDelayPause' => ['required', 'min:1', 'max:10', 'integer'],
            'propRecorderDelayStop' => ['required', 'min:1', 'max:100', 'integer'],
            'propRecorderMinDuration' => ['required', 'min:0', 'max:100', 'integer'],
            'propRecorderMaxDuration' => ['required', 'min:10', 'max:1000', 'integer'],
            'propRecorderPlay' => ['required', 'min:0', 'max:1', 'integer'],
            'propRecorderFile' => ['required', 'min:0', 'max:1', 'integer'],
            'propExportLimit' => ['required', 'min:0', 'max:100', 'integer'],
            'propExportSleep' => ['required', 'min:0', 'max:10', 'integer'],
            'propExportSeparate' => ['required', 'min:0', 'max:1', 'integer'],
            'propExporterDelay' => ['required', 'min:1', 'max:5000', 'integer'],
            'propAppMode' => ['required', 'min:0', 'max:1', 'integer'],
            'propAppRegister' => ['required', 'min:0', 'max:1', 'integer'],
            'propAppPaginator' => ['required', 'min:1', 'max:100', 'integer'],
        ];
    }
}
