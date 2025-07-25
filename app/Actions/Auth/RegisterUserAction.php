<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\Auth\EmailVerificationService;

class RegisterUserAction
{
    public function execute(array $data): void
    {
        $user  = User::create($data);

        app(EmailVerificationService::class)->send($user->email);
    }
}
