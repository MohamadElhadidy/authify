<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\Auth\ResetPasswordService;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function __construct(public ResetPasswordService $resetPasswordService) {}
    /**
     * Handle the incoming request.
     */
    public function create(Request $request)
    {
        try {
            $this->resetPasswordService->validate($request);
        } catch (\Throwable $e) {
            report($e);
            return redirect()->route('login')->with([
                'message' => 'Invalid or expired reset link.',
                'status' => 'error',
            ]);
        }

        return view('auth.reset-password');
    }


    public function store(ResetPasswordRequest $request)
    {
        try {
            $this->resetPasswordService->reset($request);

            return redirect()->route('login')->with([
                'message' => 'Password reset successfully. You can now login with your new password.',
                'status' => 'success',
            ]);
        } catch (\Throwable $e) {
            report($e);

            return redirect()->route('login')->with([
                'message' => 'Invalid or expired reset link.',
                'status' => 'error',
            ]);
        }
    }
}
