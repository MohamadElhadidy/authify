<?php

namespace App\Actions;

use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DeleteOldPasswordTokens
{
    public function execute(string $email = null): void
    {
        // Step 1: Delete all expired tokens (globally)
        DB::table('password_reset_tokens')
            ->where('created_at', '<', Carbon::now()->subMinutes(60))
            ->delete();

        if ($email) {
            // Step 2: Delete all tokens for this user (clean slate)
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->delete();
        }
    }
}
