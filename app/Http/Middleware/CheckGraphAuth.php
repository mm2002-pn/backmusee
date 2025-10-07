<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckGraphAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // $csrfTokenFromRequest  = $request->hasCookie('XSRF-TOKEN') ? $request->cookie('XSRF-TOKEN') : null;
        // $ifBe =  $request->hasCookie('Bearer') ? $request->cookie('Bearer') : null;

        // if ($csrfTokenFromRequest !== csrf_token() || !$ifBe) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }

        return $next($request);
    }
}
