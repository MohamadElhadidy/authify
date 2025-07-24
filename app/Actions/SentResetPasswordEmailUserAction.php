<?php

namespace App\Actions;

use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SentResetPasswordEmailUserAction
{
    public function execute(string $email): void
    {
        // Step 1: Delete all expired tokens 
        app(DeleteOldPasswordTokens::class)->execute($email);

        $user = User::where('email', $email)->first();

        if ($user) {
            $token = Str::random(60);

            DB::insert('insert into password_reset_tokens (email, token, expired_at) values (?, ?, ?)', [$user->email, Hash::make($token), Carbon::now()->addHours(24)]);

            $url  = url('/reset-password?token=' . $token . '&email=' . $user->email);

            // Step 3: Send the email
            Mail::to($user->email)->send(new ResetPassword($url, $user->email));
        }
    }
}
