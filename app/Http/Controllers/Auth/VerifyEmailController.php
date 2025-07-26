<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Auth\EmailVerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,  $id, EmailVerificationService $service)
    {

        try {
            $service->verify($request,  $id);

            if (Auth::check()) {
                return redirect()->route('home')->with('status', 'Your email has been verified. Login to continue.');
            }

            return redirect()->route('login')->with('status', 'Your email has been verified. Login to continue.');
        } catch (\Throwable $e) {
            report($e);
            abort(403, 'Invalid or expired verification link.');
        }
    }
}
