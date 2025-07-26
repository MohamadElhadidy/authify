<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Services\Auth\ResetPasswordService;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ForgotPasswordRequest $request, ResetPasswordService $service)
    {
        try {
            $service->send($request->email);
            return back()->with(['message' => 'If your email is registered, we’ve sent a password reset link.', 'status' => 'success']);
        } catch (\Exception $e) {
            report($e);
            return back()->with(['message' => 'An error occurred while sending the password reset link. Please try again later.', 'status' => 'error']);
        }
    }
}
