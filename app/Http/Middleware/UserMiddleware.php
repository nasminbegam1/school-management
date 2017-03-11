<?php

namespace App\Http\Middleware;

use Closure;

use \Redirect;

class UserMiddleware
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
        if(\Auth::guard('users')->check() == false && \Auth::guard('users')->user() == null){
            return Redirect::route('login');
        }
        return $next($request);
    }
}
