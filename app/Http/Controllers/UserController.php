<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Usertype, App\User;

class UserController extends Controller
{
    public function login(Request $request){
        $data                   = array();
        $data['usertype']       = Usertype::pluck('type','id')->all();
        
        if( $request->isMethod('post') ){
            $data['usertype']       = '';
            $data['email']          = '';
            $data['password']       = '';
            
            $validator              = Validator::make($request->all(), ['email'=>'required|email','password' => 'required']);
            
            if($validator->fails()){
                 $messages = $validator->messages();
                 return Redirect::back()->withErrors($validator)->withInput();
            }
            else{
                $email          = $request->email;
                $password       = $request->password;
                $usertype       = $request->usertype;
                if($request->get('remember_me')){
                    $cookieJar->queue(Cookie::make('email',$email,45000));
                    $cookieJar->queue(Cookie::make('password',$password,45000));
                    $cookieJar->queue(Cookie::make('usertype',$usertype,45000));
                }
                else{
                    $cookieJar->queue(Cookie::forget('email'));
                    $cookieJar->queue(Cookie::forget('password'));
                    $cookieJar->queue(Cookie::forget('usertype'));
                }
                $checkAdminExists = User::where('email', $email)->get();
                if( count($checkAdminExists) > 0 ){
                    $checkUserstatus = User::where('email', $email)
                                                ->where('is_active','1')
                                                ->get();
                    if( count($checkUserstatus) > 0 ){
                        $auth = auth()->guard('users');
                        $userdata = array('email' => $email, 'password' => $password , 'school_user_type_id' => $usertype);
                        if($auth->attempt($userdata)){
                            dd($userdata);
                            return redirect::route('dashboard');
                        }else{
                            return redirect::back()->with('errorMessage', 'Invalid email address or/and password provided.');
                        }
                    } else{
                        return redirect::back()->with('errorMessage', 'Invalid email address or/and password provided.');
                    }
                }else{
                    return redirect::back()->with('errorMessage', 'Invalid email address or/and password provided.');
                }
            }
        }
        return view('user.login', $data);
    }
    
    public function dashboard(){
        echo 'dashboard';
    }
}
