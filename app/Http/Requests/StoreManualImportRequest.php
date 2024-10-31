<?php

namespace App\Http\Requests;

use App\Models\Prop;
use App\Rules\FreqPrecision;
use Illuminate\Foundation\Http\FormRequest;

class StoreManualImportRequest extends FormRequest
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
                'manualImportPath' => ['required', 'min:1', 'max:100'],
                'manualImportFreq' => ['nullable', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            ];
        } elseif ((int) $this->prop->getProp('import_disk') == 1) {
            return [
                'manualImportHost' => ['required', 'min:1', 'max:100'],
                'manualImportUsername' => ['required', 'min:1', 'max:100'],
                'manualImportPassword' => ['required', 'min:1', 'max:100'],
                'manualImportRoot' => ['required', 'min:1', 'max:100'],
                'manualImportPort' => ['required', 'min:1', 'max:100', 'integer'],
                'manualImportPassive' => ['required', 'min:0', 'max:1', 'integer'],
                'manualImportTimeout' => ['required', 'min:1', 'max:100', 'integer'],
                'manualImportFreq' => ['nullable', 'min:1', 'max:5000', 'numeric', new FreqPrecision(6)],
            ];
        } else {
            abort(404);
        }
    }
}
