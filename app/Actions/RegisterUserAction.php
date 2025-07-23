<?php

namespace App\Actions;

use App\Models\User;

class RegisterUserAction
{
    public function execute(array $data): void
    {
        $user  = User::create($data);

        app(SentEmailVerificationUserAction::class)->execute($user->email);
    }
}
