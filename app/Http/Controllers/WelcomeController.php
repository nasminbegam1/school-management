<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Usertype, App\User, App\School;
use \Session, \Validator,\Redirect, \Cookie;
use Illuminate\Cookie\CookieJar;
use Illuminate\Cookie\CookieServiceProvider;
class WelcomeController extends Controller
{

		public $form_email = 'begam.nasmin91@gmail.com';

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
	                $user->school_id       			 = $request->school_id;
	                $user->name                      = $request->name;
	                $user->email                     = $request->email;
	                $user->password                  = $request->password;
	                $user->mob1                      = $request->mob1;
	                $user->mob2                      = $request->mob2;
	                $user->is_active                 = 0;
	                $user->remember_token            = csrf_token();
	                $user->save();
	                
	                $data['from_email']     = $this->form_email;
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
	        $data['schools']       	= School::pluck('School_Name','ID')->all();
	        return view('user.registration',$data);
	    }
	    
	    public function active_by_user($remember_token){
	        $data                   = array();
	        $user                   = User::where('remember_token' , $remember_token)->first();
	        if(count($user) > 0){
	        $data['from_email']     = $user->email;
	        $data['form_name']      = $user->name;
	        $data['to_email']       =  $this->form_email;;
	        $data['to_name']        = "School Management System";
	        $data['subject']		= "New user - Request for approval";
	        
	        //$mail = \Mail::send('emails.signup_mailto_admin', $data, function ($message) use ($data) {
	        //    $message->from($data['from_email'], $data['form_name']);
	        //    $message->subject($data['subject']);
	        //    $message->to($data['to_email'] );
	        //});
	        $user->is_email_verified = 1;
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

	    public function forgot_password(Request $request){
	    	$data =[];	
	    	if($request->isMethod('post')){
	    		$email = $request->email;
	    		$user = User::where('email',$email)->first();
	    		if($user !=null){
	    			$newPassword = str_random(6);
	    			$newPassword = '123456';
	    			$user->password = $newPassword;
	    			$user->save();

	    			$data['from_email']     =  $this->form_email;
	                $data['form_name']      = "School Management System" ;
	                $data['to_email']       = $user->email;
	                $data['to_name']        = $user->name;
	                $data['subject']		= 'Thank you for Signup';
	                $data['password']		= $newPassword;
	             
	                //$mail = \Mail::send('emails.forgot_password', $data, function ($message) use ($data) {
	                //    $message->from($data['from_email'], $data['form_name']);
	                //    $message->subject($data['subject']);
	                //    $message->to($data['to_email'] );
	                //});

	                return Redirect::route('login')->with('successMessage', 'New password is send to your registerd Email <br/> Please Check the mail inbox to get the new password');
	    		}else{
	    			return Redirect::back()->with('errorMessage', 'Email is not recognized by our system');
	    		}
	    	}
	    	return view('user.forgot_password', $data);
	    }

	    public function change_status(Request $request){
	    	$status 	= $request->status;
	    	$id 		= $request->id;
	    	$type 		= $request->type;

	    	switch($type){
	    		case "user":
	    			$user = \App\User::find($id);
	    			if($status == 1){
	    				$user->is_deleted  = 1;
	    				$status = 0;
	    				$user->save();
	    			}else{
	    				$user->is_active = $status = 1;
	    				$user->save();
	    				$data['from_email']     =  $this->form_email;
		                $data['form_name']      = "School Management System" ;
		                $data['to_email']       = $user->email;
		                $data['to_name']        = $user->name;
		                $data['subject']		= 'Account Activation from Admin';
		             	
		                //$mail = \Mail::send('emails.after_active_mailto_user', $data, function ($message) use ($data) {
		                //    $message->from($data['from_email'], $data['form_name']);
		                //    $message->subject($data['subject']);
		                //    $message->to($data['to_email'] );
		                //});
	    			}
	    			
	    		break;
	    	}

	    	echo json_encode(['status'=>$status]);die;
	    }

}
