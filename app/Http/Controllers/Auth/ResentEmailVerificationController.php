<?php

namespace App\Http\Controllers\Auth;

use App\Actions\SentEmailVerificationUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResentEmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $user= Auth::user();

        app(SentEmailVerificationUserAction::class)->execute($user->email);

        return back()->with('status', 'verification-link-sent');
    }
}
