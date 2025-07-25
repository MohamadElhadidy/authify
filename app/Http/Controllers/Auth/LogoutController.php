<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LogoutUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
