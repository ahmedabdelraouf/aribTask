<?php

namespace App\Rules;

use App\Models\Department;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidDepartmentID implements ValidationRule
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
        return $value === 0 || is_null($value) || Department::where('id', $value)->exists();
    }

    public function message()
    {
        return 'The selected department is invalid.';
    }
}
