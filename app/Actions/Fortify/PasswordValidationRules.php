<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            Password::min(12) // Minimum length of 12 characters
            ->mixedCase() // Require at least one uppercase and one lowercase letter
            ->letters() // Require at least one letter
            ->numbers() // Require at least one number
            ->symbols() // Require at least one symbol
            ->uncompromised(), // Check if the password has been compromised in a data breach
            'confirmed'
        ];
    }
}
