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
            'propFtpHost' => ['required', 'min:2', 'max:100'],
            'propFtpUsername' => ['required', 'min:2', 'max:100'],
            'propFtpPassword' => ['required', 'min:2', 'max:100'],
            'propFtpPort' => ['required', 'min:0', 'max:100', 'numeric'],
            'propFtpLimit' => ['required', 'min:0', 'max:100', 'integer'],
            'propFtpRedirect' => ['required', 'min:0', 'max:1', 'integer'],
            'propRegisterOption' => ['required', 'min:0', 'max:1', 'integer'],
        ];
    }
}
