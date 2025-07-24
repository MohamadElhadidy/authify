<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class VerifyEmailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        if (!URL::hasValidSignature($request)) {
            abort(403, 'Invalid or expired verification link.');
        }

        $user = User::findOrFail($id);

        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }
        
        if(Auth::check()){
            return redirect()->route('home')->with('status', 'Your email has been verified. Login to continue.');
        }

        return redirect()->route('login')->with('status', 'Your email has been verified. Login to continue.');
    }
}
