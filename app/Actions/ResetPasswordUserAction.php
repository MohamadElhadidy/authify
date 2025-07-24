<?php

namespace App\Actions;

use App\Actions\DeleteOldPasswordTokens;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ResetPasswordUserAction
{
    public function execute($request) : bool
    {
        $record  = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        $user = User::where('email', $request->email)->first();

        if (!$record  || !$user || !Hash::check($request->token, $record->token)) {
            return false;
        }

        $user->password = Hash::make($request->password);
        $user->save();

        app(DeleteOldPasswordTokens::class)->execute();

        return true;
    }
}
