<?php

namespace App\Http\Requests;

use App\Models\Prop;
use App\Rules\FreqPrecision;
use Illuminate\Foundation\Http\FormRequest;

class StoreManualConnectRequest extends FormRequest
{
    public function __construct (public Prop $prop) {
        parent::__construct();
    }

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
        if ((int) $this->prop->getProp('import_disk') == 0) {
            return [
                'manualConnectPath' => ['required', 'min:1', 'max:100'],
                'manualConnectFreq' => ['nullable', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            ];
        } elseif ((int) $this->prop->getProp('import_disk') == 1) {
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
        } else {
            abort(404);
        }
    }
}
