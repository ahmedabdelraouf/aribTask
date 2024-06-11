<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidManagerID implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Check if the value is either 0, null, or exists in the departments table
        return $value === 0 || is_null($value) || User::where('role', User::ROLE_MANAGER)->where('id', $value)->exists();
    }

    public function message()
    {
        return 'The selected Manager is invalid.';
    }
}
