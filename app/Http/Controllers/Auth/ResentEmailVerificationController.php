<?php

namespace App\Http\Controllers\Auth;

use App\Actions\SentEmailVerificationUserAction;
use App\Http\Controllers\Controller;
use App\Services\Auth\EmailVerificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class ResentEmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if (RateLimiter::tooManyAttempts(key: 'resentEmailVerification:' . request()->ip(), maxAttempts: 2)) {
            return back()->with(['status' => 'You have exceeded the number of attempts. Please try again later.', 'type' => 'danger']);
        }

        $user = Auth::user();

        app(EmailVerificationService::class)->send($user->email);

        RateLimiter::increment(key: 'resentEmailVerification:' . request()->ip());

        return back()->with(['status' => 'A new verification link has been sent to your email address.', 'type' => 'success']);
    }
}
