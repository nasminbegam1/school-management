<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Usertype, App\User;
use \Session, \Validator,\Redirect, \Cookie;
use Illuminate\Cookie\CookieJar;
use Illuminate\Cookie\CookieServiceProvider;

class UserController extends Controller
{
    public function login(Request $request, CookieJar $cookieJar){
        if(\Auth::guard('users')->check() == true){
            return Redirect::route('dashboard');
        }
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
                                                ->where('is_deleted',0)
                                                ->get();
                    if( count($checkUserstatus) > 0 ){
                        $auth = auth()->guard('users');
                        $userdata = array('email' => $email, 'password' => $password , 'school_user_type_id' => $usertype);
                        if($auth->attempt($userdata)){
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
        //dd(\Auth::guard('users')->user());
        $data = array();
        return view('user.dashboard',$data);
    }
    
    public function logout(){
        \Auth::guard('users')->logout();
        return Redirect::route('login');
    }
    
    public function registration(Request $request){
        if(\Auth::guard('users')->check() == true){
            return Redirect::route('dashboard');
        }
        
        if( $request->isMethod('post') ){
            $validator              = Validator::make($request->all(),
                                            ['usertype'     => 'required',
                                             'user_id'      => 'required',
                                             'name'         => 'required',
                                             'email'        => 'required|email|unique:users',
                                             'password'     => 'required',
                                             'mob1'         => 'required'
                                             ]
                                        );
            
            if($validator->fails()){
                 $messages = $validator->messages();
                 return Redirect::back()->withErrors($validator)->withInput();
            }
            else{
                $user                            = new User();
                $user->user_id                   = $request->user_id;
                $user->school_user_type_id       = $request->usertype;
                $user->name                      = $request->name;
                $user->email                     = $request->email;
                $user->password                  = $request->password;
                $user->mob1                      = $request->mob1;
                $user->mob2                      = $request->mob2;
                $user->is_active                 = 0;
                $user->remember_token            = csrf_token();
                $user->save();
                
                $data['from_email']     = 'begam.nasmin91@gmail.com';
                $data['form_name']      = "School Management System" ;
                $data['to_email']       = $user->email;
                $data['to_name']        = $user->name;
                $data['link']           = \URL::route('active_by_user',$user->remember_token);
                $data['subject']	= 'Thank you for Signup';
                
                //$mail = \Mail::send('emails.signup_mailto_user', $data, function ($message) use ($data) {
                //    $message->from($data['from_email'], $data['form_name']);
                //    $message->subject($data['subject']);
                //    $message->to($data['to_email'] );
                //});
                return redirect::route('dashboard')->with('success','Please check your mail to active account');
            }
        }
        $data                   = array();
        $data['usertype']       = Usertype::pluck('type','id')->all();
        return view('user.registration',$data);
    }
    
    public function active_by_user($remember_token){
        $data                   = array();
        $user                   = User::where('remember_token' , $remember_token)->first();
        if(count($user) > 0){
        $data['from_email']     = $user->email;
        $data['form_name']      = $user->name;
        $data['to_email']       = "begam.nasmin91@gmail.com";
        $data['to_name']        = "School Management System";
        $data['subject']	= "New user - Request for approval";
        
        //$mail = \Mail::send('emails.signup_mailto_admin', $data, function ($message) use ($data) {
        //    $message->from($data['from_email'], $data['form_name']);
        //    $message->subject($data['subject']);
        //    $message->to($data['to_email'] );
        //});
        
        $user->remember_token = '';
        $user->save();
        
        return redirect::route('thank_you')->with('success','Please login and approve user. New user waiting for your approval');
        }else{
        return redirect::route('thank_you')->with('error','User not found');   
        }
    }
    
    public function thank_you(){
        $data = array();
        return view('user.thank_you',$data);
    }
    public function edit_profile(Request $request){
        $data               = array();
        $data['users']      = User::find(\Auth::guard('users')->user()->id);
        return view('user.edit_profile',$data);
    }
    public function edit_profile_store(Request $request){
        $data               = array();
        
        $validator              = Validator::make($request->all(),
                                        ['name'         => 'required',
                                         'email'        => 'required|email|unique:users,email,'.\Auth::guard('users')->user()->id,
                                         'mob1'         => 'required'
                                         ]
                                    );
        
        if($validator->fails()){
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $user           = User::find(\Auth::guard('users')->user()->id);
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->mob1     = $request->mob1;
            $user->mob2     = $request->mob2;
            $user->save();
            return redirect::route('edit_profile')->with('success','Profile updated succesffully!');
        }
    }
    public function account_settings(){
        $data               = array();
        return view('user.account_settings',$data);
    }
    
    public function account_update(Request $request){
        $data               = array();
        $validator          = Validator::make($request->all(),
                                    ['password'                     => 'required|confirmed',
                                     'password_confirmation'        => 'required'
                                     ]
                                );
        
        if($validator->fails()){
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $user               = User::find(\Auth::guard('users')->user()->id);
            $user->password     = $request->password;
            $user->save();
            return redirect::route('account_settings')->with('success','Profile updated succesffully!');
        }
    }
    public function lists(Request $request){
        $data                   = array();
        $data['keyword']        = '';
        $data['registerdate']   = '';
        $data['status']         = '';
        if($request->keyword != '' || $request->registerdate != '' || $request->status != ''){
            $data['keyword']            = $request->keyword;
            $data['registerdate']       = $request->registerdate;
            $data['status']             = $request->status;
            $data['lists']              = User::where('id','<>',\Auth::guard('users')->user()->id)
                                                ->where(function($query) use ($data) {
                                                if($data['keyword'] != ''){
                                                    $query->where('name','like','%'.$data['keyword'].'%');
                                                    $query->orWhere('email','like','%'.$data['keyword'].'%');
                                                }
                                                if($data['status'] != ''){
                                                    if($data['status'] == 'accepted'){
                                                        $query->where('is_active',1);
                                                    }elseif($data['status'] == 'deleted'){
                                                        $query->where('is_deleted',1);
                                                    }
                                                }
                                                if($data['registerdate'] != ''){
                                                    $query->whereRaw("DATE_FORMAT(created_at, '%m/%d/%Y')='".$data['registerdate']."'");
                                                }
                                            })
                                            ->orderBy('id','asc')->paginate(15);
                                            //dd($data['lists']);
        }
        else{
            $data['lists']              = User::where('id','<>',\Auth::guard('users')->user()->id)->orderBy('id','asc')->paginate(15);
        }
        return view('user.list',$data);
    }
    
    public function role_assign($id){
        $data               = array();
        $data['users']      = User::find($id);
        $data['usertype']   = Usertype::pluck('type','id')->all();
        return view('user.role_assign',$data);
    }
    
    public function role_assign_update(Request $request,$id){
        $data               = array();
        
        $validator              = Validator::make($request->all(),
                                        ['role_assign'         => 'required']
                                    );
        if($validator->fails()){
             $messages = $validator->messages();
             return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $user                           = User::find($id);
            $user->school_user_type_id      = $request->role_assign;
            $user->save();
            return redirect::route('user_list')->with('success','Profile updated succesffully!');
        }
    }
}
