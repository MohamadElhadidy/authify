<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request, RegisterUserAction $action)
    {

        try {
            throw new \Exception('Test exception');
            $action->execute($request->validated());

            return redirect()->route('login')->with([
                'status' => 'success',
                'message' => 'Please check your email to verify your account.'
            ]);
        } catch (\Throwable  $e) {
            report($e);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Registration failed. Please try again later.'
            ]);
        }
    }
}
