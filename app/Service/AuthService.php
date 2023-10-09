<?php

namespace App\Service;

use App\Events\UserLoggedIn;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public static function login(Request $userLogin): ?Authenticatable
    {
        if (! Auth::attempt($userLogin->all())) {
            return null;
        }
        event(new UserLoggedIn(Auth::id(), Carbon::now()));

        return Auth::user();
    }
}
