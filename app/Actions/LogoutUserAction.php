<?php

namespace App\Actions;

use Illuminate\Support\Facades\Auth;


class LogoutUserAction
{
    public function execute() : void
    {
       Auth::logout();
    }
}
