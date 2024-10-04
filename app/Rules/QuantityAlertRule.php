<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class QuantityAlertRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Assuming 'quantity' is passed in the validation context
        $quantity = request()->input('quantity'); // Adjust this line based on your actual data source

        if ($value > $quantity) {
            $fail("Quantity Alert must not be greater than quantity.");
        }
    }
}
