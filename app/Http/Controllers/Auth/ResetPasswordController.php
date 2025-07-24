<?php

namespace App\Http\Controllers\Auth;

use App\Actions\ResetPasswordUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResetPasswordRequest $request)
    {
        $reset = app(ResetPasswordUserAction::class)->execute($request);
        if (!$reset) {
            return back()->withErrors([
                'password' => 'Invalid or expired reset link.',
            ]);
        }

        return redirect()->route('login')->with('status', 'Password reset successfully.');
    }
}
