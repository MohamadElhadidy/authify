<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginUserAction
{
    public function execute(array $data, $remember_me = false): void
    {
        if (Auth::attempt($data, $remember_me)) {
            request()->session()->regenerate();
        } else {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials do not match our records.'],
            ]);
        }
    }
}
