<?php

namespace App\Http\Requests;

use App\Rules\FreqPrecision;
use Illuminate\Foundation\Http\FormRequest;

class StoreManualExportRequest extends FormRequest
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
            'manualExportPath' => ['required', 'min:1', 'max:100'],
            'manualExportHost' => ['required', 'min:1', 'max:100'],
            'manualExportUsername' => ['required', 'min:1', 'max:100'],
            'manualExportPassword' => ['required', 'min:1', 'max:100'],
            'manualExportRoot' => ['required', 'min:1', 'max:100'],
            'manualExportPort' => ['required', 'min:1', 'max:100', 'integer'],
            'manualExportPassive' => ['required', 'min:0', 'max:1', 'integer'],
            'manualExportTimeout' => ['required', 'min:1', 'max:100', 'integer'],
            'manualExportFreq' => ['nullable', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
        ];
    }
}
