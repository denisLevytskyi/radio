<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use App\Models\User;

class UpdateAdminRequest extends FormRequest
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
            'adminEditName' => ['required', 'string', 'max:255'],
            'adminEditEmail' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class, 'email')->ignore($this->admin)],
            'adminEditPin' => ['nullable', 'required_with:adminEditToken', 'min:1000', 'max:9999', 'integer'],
            'adminEditToken' => ['nullable', 'required_with:adminEditPin', 'min:100', 'max:1000'],
            'adminEditPassword' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
