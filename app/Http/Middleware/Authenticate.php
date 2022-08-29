<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request;

class Authenticate extends Middleware
{

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (Request::is('dashboard/*'))
            {
                return route('getLogin');
            }
            else
            {
                return route('register');
            }
        }
    }
}
