<?php

namespace App\Http\Middleware;

use Closure;

use \Redirect, \Cookie, \Auth;
use \App\User;

use Illuminate\Cookie\CookieJar;
use Illuminate\Cookie\CookieServiceProvider;
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
            $keep_alive = Cookie::get('keep_me_active');
            if($keep_alive == 1){
                $auth = auth()->guard('users');
                $password = Cookie::get('keep_password');
                $usertype = Cookie::get('keep_usertype');
                $user_id_email = Cookie::get('keep_user_id_email');
                $checkUserstatus = User::where('email', $user_id_email)
                                                    ->orWhere('user_id', $user_id_email)
                                                    ->where('is_active','1')
                                                    ->where('is_deleted',0)
                                                    ->first();
                $userdata = [ 'password' => $password , 'school_user_type_id' => $usertype ];
                if($checkUserstatus->user_id == $user_id_email){
                     $userdata['user_id'] = $user_id_email;
                }elseif($checkUserstatus->email == $user_id_email){
                     $userdata['email'] = $user_id_email;
                }
                $auth->attempt($userdata);

            }
            return Redirect::route('login');
        }
        return $next($request);
    }
}
