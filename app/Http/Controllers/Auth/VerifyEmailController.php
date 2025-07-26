<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\EmailVerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id, EmailVerificationService $service)
    {
        try {
            $service->verify($request, $id);
            if (Auth::check()) {
                return redirect()->route('home')->with(['message' => 'Your email has been verified. Login to continue.', 'status' => 'success']);
            }
            return redirect()->route('login')->with(['message' => 'Your email has been verified. You can now login.', 'status' => 'success']);
        
        } catch (\Throwable $e) {
            report($e);
            if (Auth::check()) {
                return redirect()->route('verification.notice')->with(['message' => 'Invalid or expired verification link. Please resend the verification email.', 'status' => 'error']);
            }
            return redirect()->route('login')->with(['message' => 'Invalid or expired verification link. Please login again.', 'status' => 'error']);
        }
    }
}
