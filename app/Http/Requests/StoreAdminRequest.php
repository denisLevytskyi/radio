<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use App\Models\User;

class StoreAdminRequest extends FormRequest
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
            'adminCreateName' => ['required', 'string', 'max:255'],
            'adminCreateEmail' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class.',email'],
            'adminCreatePin' => ['nullable', 'required_with:adminCreateToken', 'min:1000', 'max:9999', 'integer'],
            'adminCreateToken' => ['nullable', 'required_with:adminCreatePin', 'min:100', 'max:1000'],
            'adminCreatePassword' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
