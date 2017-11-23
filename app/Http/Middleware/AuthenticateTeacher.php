<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateTeacher
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
        if(!Auth::guard('teacher')->check())
            return redirect()->route('teacher.login');
        if(Auth::guard('teacher')->user()->status == 0)
            return redirect()->route('teacher.login')->withErrors('Please active your account in your  email!!');
        return $next($request);
    }
}
