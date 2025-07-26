<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\EmailVerificationService;
use Illuminate\Support\Facades\Auth;

class ResendVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EmailVerificationService $service)
    {

        try {
            $user = Auth::user();

            if ($user->hasVerifiedEmail()) {
                return redirect()->route('home')->with(['message' => 'Your email address is already verified.', 'status' => 'success']);
            }

            $service->send($user->email);

            return back()->with(['message' => 'A new verification link has been sent to your email address.', 'status' => 'success']);
        } catch (\Throwable $e) {
            report($e);
            return back()->with(['message' => 'Failed to send verification email. Please try again later.', 'status' => 'error']);
        }
    }
}
