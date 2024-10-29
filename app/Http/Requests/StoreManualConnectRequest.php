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
                'manualConnectSelfPath' => ['required', 'min:1', 'max:100'],
                'manualConnectFreq' => ['nullable', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            ];
        } elseif ((int) $this->prop->getProp('import_disk') == 1) {
            return [
                'manualConnectFtpHost' => ['required', 'min:1', 'max:100'],
                'manualConnectFtpUsername' => ['required', 'min:1', 'max:100'],
                'manualConnectFtpPassword' => ['required', 'min:1', 'max:100'],
                'manualConnectFtpRoot' => ['required', 'min:1', 'max:100'],
                'manualConnectFtpPort' => ['required', 'min:1', 'max:100', 'integer'],
                'manualConnectFtpPassive' => ['required', 'min:0', 'max:1', 'integer'],
                'manualConnectFtpTimeout' => ['required', 'min:1', 'max:100', 'integer'],
                'manualConnectFreq' => ['nullable', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            ];
        } else {
            abort(404);
        }
    }
}
