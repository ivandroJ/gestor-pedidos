<?php

namespace App\Rules;

use App\Actions\Pedidos\TransformCurrencyFormatToNumericAction;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CurrencyRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $action = new TransformCurrencyFormatToNumericAction();

        $quantia = $action->execute($value);

        if (!is_numeric($quantia)) {
            $fail('validation.decimal')->translate();
        }
    }
}
