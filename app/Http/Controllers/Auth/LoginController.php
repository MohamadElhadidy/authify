<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LoginUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        if (RateLimiter::tooManyAttempts(key: 'login:' . request()->ip(), maxAttempts: 5)) {
            return back()->withErrors([
                'email' => 'You have exceeded the number of attempts. Please try again later.',
            ])->onlyInput('email');
        }

        $login = app(LoginUserAction::class)->execute($request->validated(), $request->remember_me);

        if ($login) {
            RateLimiter::clear(key: 'login:' . request()->ip());
            return redirect()->intended();
        }

        RateLimiter::increment(key: 'login:' . request()->ip());
        
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
