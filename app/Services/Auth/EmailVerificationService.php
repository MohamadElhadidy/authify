<?php

namespace App\Services\Auth;

use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailVerificationService
{
    public function send(string $email): void
    {
        $user  = User::where('email', $email)->first();

        if (!$user) {
            throw new \Exception('User not found.');
        }

        $url = URL::temporarySignedRoute(
            'verification.verify.custom',
            Carbon::now()->addMinutes(60),
            ['id' => $user->id]
        );

        Mail::to($email)->queue(new VerifyEmail($user, $url));
    }

    public function verify(Request $request, string $id): void
    {
        if (!URL::hasValidSignature($request)) {
            throw new \Exception('Invalid or expired verification link.');
        }

        $user = User::findOrFail($id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    }
}
