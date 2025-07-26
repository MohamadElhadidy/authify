<?php

namespace App\Services\Auth;

use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;


class ResetPasswordService
{
    public function send(string $email): void
    {
        $user = User::where('email', $email)->first();

        if ($user) {
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();

            $token = Str::random(60);

            DB::insert('insert into password_reset_tokens (email, token, expired_at) values (?, ?, ?)', [$user->email, Hash::make($token), Carbon::now()->addMinutes(60)]);

            $url  = url('/reset-password?token=' . $token . '&email=' . $user->email);

            Mail::to($user->email)->queue(new ResetPassword($url, $user->email));
        }
    }

    public function validate(Request $request): void
    {
        $record  = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        $user = User::where('email', $request->email)->first();

        if (!$record  || !$user || !Hash::check($request->token, $record->token) || $record->expired_at < Carbon::now()) {
            throw new \Exception('Invalid or expired reset link.');
        }
    }


    public function reset(Request $request): void
    {
        $this->validate($request);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
    }
}
