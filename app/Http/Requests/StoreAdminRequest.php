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
            'adminCreatePassword' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
