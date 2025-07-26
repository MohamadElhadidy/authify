<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\Auth\EmailVerificationService;

class RegisterUserAction
{
    public function execute(array $data, EmailVerificationService $service): void
    {
        $user  = User::create($data);

        $service->send($user->email);
    }
}
