<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LogoutUserAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        app(LogoutUserAction::class)->execute();
        
        return redirect()->route('login');
    }
}
