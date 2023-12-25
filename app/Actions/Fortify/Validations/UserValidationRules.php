<?php

namespace App\Actions\Fortify\Validations;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserValidationRules
{
    use PasswordValidationRules;
    public function userRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
                Rule::unique(Admin::class),
            ],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => $this->passwordRules(),
        ];
    }
}
