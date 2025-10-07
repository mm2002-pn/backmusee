<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate  extends Middleware
{
     /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function redirectTo($request)
    {

        \Log::info('Authenticate middleware triggered', [
            'auth' => Auth::check(),
            'user' => Auth::user(),
            'expectsJson' => $request->expectsJson()
        ]);
        if (!$request->expectsJson()) {
            return route('login');
        }
        
        return null;
    }
   
}
