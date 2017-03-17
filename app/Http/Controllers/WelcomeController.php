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
			/*$u = User::select('school_user_type_id','user_id')->lists('school_user_type_id','user_id');
			dd($u);*/
	        if(\Auth::guard('users')->check() == true){
	            return Redirect::route('dashboard');
	        }
	        $data                   	= array();
	        $data['usertype']       	= Usertype::pluck('type','id')->all();
	        $data['log']['user_id_email'] 	= '';
	        $data['log']['password'] 	= '';
	        $data['log']['usertype'] 	= '';
	        if(Cookie::has('remember_user_id_email') !=''){
	        	$data['log']['user_id_email'] = Cookie::get('remember_user_id_email');
	        }
	        if(Cookie::has('remember_usertype') !=''){
	        	$data['log']['usertype'] = Cookie::get('remember_usertype');
	        }
	        
	        return view('user.login', $data);
	    }

            public function login_post(Request $request, CookieJar $cookieJar){
	        if( $request->isMethod('post') ){
		    if($request->type == 'mobile'){
			$user_id_email          = $request->user_id_email;
	                $password       	= $request->password;
	                $usertype       	= $request->usertype;
	                $checkUserstatus = User::where(function($query) use ($user_id_email)
								{
								    $query->where("email",$user_id_email)
									  ->orWhere("user_id",$user_id_email);
								})
	                                                ->where('is_active','1')
	                                                ->where('is_deleted',0)
	                                                ->first();
	                    if( count($checkUserstatus) > 0 ){
	                        $auth = auth()->guard('users');
	                        $userdata = [ 'password' => $password , 'school_user_type_id' => $usertype ];
	                        if($checkUserstatus->user_id == $user_id_email){
	                        	 $userdata['user_id'] = $user_id_email;
	                        }elseif($checkUserstatus->email == $user_id_email){
	                        	 $userdata['email'] = $user_id_email;
	                        }
	                       
	                        if($auth->attempt($userdata)){
				    $data = array('response'=>'success','msg'=>'User logged on successfully!','data'=>\Auth::guard('users')->user());
	                            //return redirect::route('dashboard');
	                        }else{
				     $data = array('response'=>'error','msg'=>'Invalid user id or email or password provided.','data'=>'');
	                        }
	                    } else{
				$data = array('response'=>'error','msg'=>'Invalid user id or email or password provided.','data'=>'');
	                    }
			    return json_encode($data);
		    }else{
	            $data['usertype']       = '';
	            $data['user_id_email']  = '';
	            $data['password']       = '';
	            
	            $validator              = Validator::make($request->all(), ['user_id_email'=>'required','password' => 'required']);
	            
	            if($validator->fails()){
	                 $messages = $validator->messages();
	                 return Redirect::back()->withErrors($validator)->withInput();
	            }else{
	                $user_id_email  = $request->user_id_email;
	                $password       = $request->password;
	                $usertype       = $request->usertype;
	                if($request->get('keep_me_login')){
	                    $cookieJar->queue(Cookie::make('keep_user_id_email',$user_id_email,45000));
	                    $cookieJar->queue(Cookie::make('keep_password',$password,45000));
	                    $cookieJar->queue(Cookie::make('keep_usertype',$usertype,45000));
	                    $cookieJar->queue(Cookie::make('keep_me_active',1,45000));
	                }
	                else{
	                    $cookieJar->queue(Cookie::forget('keep_user_id_email'));
	                    $cookieJar->queue(Cookie::forget('keep_password'));
	                    $cookieJar->queue(Cookie::forget('keep_usertype'));
	                    $cookieJar->queue(Cookie::forget('keep_me_active'));
	                }

	                if($request->get('remember_me')){
	                    $cookieJar->queue(Cookie::make('remember_user_id_email',$user_id_email,45000));
	                    $cookieJar->queue(Cookie::make('remember_password',$password,45000));
	                    $cookieJar->queue(Cookie::make('remember_usertype',$usertype,45000));
	                }
	                else{
	                    $cookieJar->queue(Cookie::forget('remember_user_id_email'));
	                    $cookieJar->queue(Cookie::forget('remember_password'));
	                    $cookieJar->queue(Cookie::forget('remember_usertype'));
	                }
	                $checkUserstatus = User::where(function($query)
								{
								    $query->where("email",$user_id_email)
									  ->orWhere("user_id",$user_id_email);
								})
	                                                ->where('is_active','1')
	                                                ->where('is_deleted',0)
	                                                ->first();

	                    if( count($checkUserstatus) > 0 ){
	                        $auth = auth()->guard('users');
	                        $userdata = [ 'password' => $password , 'school_user_type_id' => $usertype ];
	                        if($checkUserstatus->user_id == $user_id_email){
	                        	 $userdata['user_id'] = $user_id_email;
	                        }elseif($checkUserstatus->email == $user_id_email){
	                        	 $userdata['email'] = $user_id_email;
	                        }
	                       
	                        if($auth->attempt($userdata)){
	                            return redirect::route('dashboard');
	                        }else{
	                            return redirect::back()->with('errorMessage', 'Invalid user id or email or password provided.');
	                        }
	                    } else{
	                        return redirect::back()->with('errorMessage', 'Invalid user id or email or password provided.');
	                    }
	            }
	        }
		}
	    }

	    
	    public function registration(Request $request){

	        if(\Auth::guard('users')->check() == true){
	            return Redirect::route('dashboard');
	        }
	        $data                   = array();
	        $data['usertype']       = Usertype::pluck('type','id')->all();
	        $data['schools']       	= School::pluck('School_Name','ID')->all();
	        return view('user.registration',$data);
	    }
	    
             public function registration_post(Request $request){

	        if( $request->isMethod('post') ){
		if($request->type == 'mobile'){
				$user                            = new User();
				$user->user_id                   = $request->user_id;
				$user->school_user_type_id       = $request->usertype;
				$user->school_id       		 = $request->school_id;
				$user->name                      = $request->name;
				$user->email                     = $request->email;
				$user->password                  = $request->password;
				$user->mob1                      = '+91'.$request->mob1;
				$user->mob2                      = '+91'.$request->mob2;
				$user->is_active                 = 0;
				$user->remember_token            = csrf_token();
				$user->save();
				
				$data['from_email']     = $this->form_email;
				$data['form_name']      = "School Management System" ;
				$data['to_email']       = $user->email;
				$data['to_name']        = $user->name;
				$data['link']           = \URL::route('active_by_user',$user->remember_token);
				$data['subject']	= 'Thank you for Signup';
	
				/*$mail = \Mail::send('emails.signup_mailto_user', $data, function ($message) use ($data) {
				   $message->from($data['from_email'], $data['form_name']);
				   $message->subject($data['subject']);
				   $message->to($data['to_email'] );
				});*/
				$data1 = array('response'=>'success','msg'=>'Please check your mail to active account','data'=>'');
				return json_encode($data1);
		}else{
	            $validator              = Validator::make($request->all(),
	                                            ['usertype'     => 'required',
	                                             'user_id'      => 'required|unique:School_User,user_id',
	                                             'name'         => 'required',
	                                             'email'        => 'required|email|unique:School_User',
	                                             'password'     => 'required',
	                                             'mob1'         => 'required'
	                                             ]
	                                        );
	            
	            if($validator->fails()){
	                 $messages = $validator->messages();
	                 return Redirect::back()->withErrors($validator)->withInput();
	            }else{
	                $user                            = new User();
	                $user->user_id                   = $request->user_id;
	                $user->school_user_type_id       = $request->usertype;
	                $user->school_id       		 = $request->school_id;
	                $user->name                      = $request->name;
	                $user->email                     = $request->email;
	                $user->password                  = $request->password;
	                $user->mob1                      = '+91'.$request->mob1;
	                $user->mob2                      = '+91'.$request->mob2;
	                $user->is_active                 = 0;
	                $user->remember_token            = csrf_token();
	                $user->save();
	                
	                $data['from_email']     = $this->form_email;
	                $data['form_name']      = "School Management System" ;
	                $data['to_email']       = $user->email;
	                $data['to_name']        = $user->name;
	                $data['link']           = \URL::route('active_by_user',$user->remember_token);
	                $data['subject']	= 'Thank you for Signup';

	                /*$mail = \Mail::send('emails.signup_mailto_user', $data, function ($message) use ($data) {
	                   $message->from($data['from_email'], $data['form_name']);
	                   $message->subject($data['subject']);
	                   $message->to($data['to_email'] );
	                });*/
	                return redirect::route('dashboard')->with('success','Please check your mail to active account');
	            }
		 }
	        }
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
	                $data['subject']		= 'Request for new password';
	                $data['password']		= $newPassword;
	             
	                $mail = \Mail::send('emails.forgot_password', $data, function ($message) use ($data) {
	                   $message->from($data['from_email'], $data['form_name']);
	                   $message->subject($data['subject']);
	                   $message->to($data['to_email'] );
	                });

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
