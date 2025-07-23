<?php

namespace App\Actions;

use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SentEmailVerificationUserAction
{
    public function execute(string $email): void
    {
        $user  = User::where('email', $email)->first();

        $url = URL::temporarySignedRoute(
            'verification.verify.custom',
            Carbon::now()->addMinutes(60),
            ['id' => $user->id]
        );

        Mail::to($user->email)->send(new VerifyEmail($user, $url));
    }
}
