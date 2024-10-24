<?php

namespace App\Http\Requests;

use App\Rules\FreqPrecision;
use Illuminate\Foundation\Http\FormRequest;

class StoreManualConnectRequest extends FormRequest
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
            'manualConnectHost' => ['required', 'min:1', 'max:100'],
            'manualConnectUsername' => ['required', 'min:1', 'max:100'],
            'manualConnectPassword' => ['required', 'min:1', 'max:100'],
            'manualConnectRoot' => ['required', 'min:1', 'max:100'],
            'manualConnectPort' => ['required', 'min:1', 'max:100', 'integer'],
            'manualConnectPassive' => ['required', 'min:0', 'max:1', 'integer'],
            'manualConnectTimeout' => ['required', 'min:1', 'max:100', 'integer'],
            'manualConnectFreq' => ['nullable', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
        ];
    }
}
