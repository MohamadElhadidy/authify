<?php

namespace App\Http\Controllers\Auth;

use App\Actions\SentResetPasswordEmailUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        app(SentResetPasswordEmailUserAction::class)->execute($request->email);

        return back()->with(['status' => 'A new reset password link has been sent to your email address.']);
    }
}
