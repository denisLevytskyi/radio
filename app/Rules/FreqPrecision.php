<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FreqPrecision implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function __construct (public int $precision) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value != round($value, $this->precision)) {
            $fail('Точность должна быть до ' . $this->precision . ' знаков.');
        }
    }
}
