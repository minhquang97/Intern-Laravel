<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('student')->check())
           return redirect()->route('student.login');
        if(Auth::guard('student')->user()->status == 0)
            return redirect()->route('student.login')->withErrors('Please active your account in your email');
        return $next($request);
    }
}
