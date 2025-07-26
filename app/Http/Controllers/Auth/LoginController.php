<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\LoginUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request, LoginUserAction $action)
    {

        try {
            $action->execute($request->validated(), $request->remember_me);

            return redirect()->intended();
        } catch (ValidationException $e) {
            report($e);
            return back()->withErrors($e->errors())->withInput();
        } catch (\Throwable $e) {
            report($e);

            return redirect()->back()->withInput()->with([
                'status' => 'error',
                'message' => 'Login failed. Please try again later.'
            ]);
        }
    }
}
