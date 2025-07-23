<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public function execute(array $data, $remember_me = false): bool
    {
        if (Auth::attempt($data, $remember_me)) {
            request()->session()->regenerate();

            return true;
        }

        return false;
    }
}
