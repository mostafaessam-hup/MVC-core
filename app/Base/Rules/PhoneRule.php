<?php

namespace App\Base\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class PhoneRule implements ValidationRule
{

    public function validate($attribute, $value, $fail): void
    {
        if (!preg_match('/^01[0125][0-9]{8}$/', $value)) {
            $fail('رقم الهاتف غير صالح');
        }
    }
}
