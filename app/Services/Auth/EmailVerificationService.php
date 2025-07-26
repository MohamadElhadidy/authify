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

        $url = URL::temporarySignedRoute(
            'verification.verify.custom',
            Carbon::now()->addMinutes(60),
            ['id' => $user->id]
        );

        Mail::to($email)->send(new VerifyEmail($user, $url));
    }

    public function verify(Request $request, string $id): bool
    {
        if (!URL::hasValidSignature($request)) {
            abort(403, 'Invalid or expired verification link.');
        }

        $user = User::findOrFail($id);

        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }

        return true;
    }
}
