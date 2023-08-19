<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Session;
use Auth;
use Closure;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request, $guard = null)
    {
        if (Auth::guard($guard)->guest()){
            Session::put('oldUrl', $request->url());
        
        if (! $request->expectsJson()) {
            return route('user.signin');
        }
    }
    }
}
