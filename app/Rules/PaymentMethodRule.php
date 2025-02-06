<?php

namespace App\Rules;

use App\Enums\PaymentMethod;
use Illuminate\Contracts\Validation\Rule as RuleContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PaymentMethodRule implements RuleContract
{
    const HANDLE = 'payment_method';

    public function passes($attribute, $value): bool
    {
        $rules = [
            'string',
            Rule::in(PaymentMethod::keys())
        ];

        return Validator::make([$attribute => $value], [
            $attribute => $rules,
        ])->passes();
    }

    public function message(): string
    {
        return 'The :attribute is not a valid payment method.';
    }
}
