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
    
    
    public function dashboard(){
        //dd(\Auth::guard('users')->user());
        $data = array();
        return view('user.dashboard',$data);
    }
    
    public function logout(CookieJar $cookieJar){
        \Auth::guard('users')->logout();
        $cookieJar->queue(Cookie::forget('keep_user_id_email'));
        $cookieJar->queue(Cookie::forget('keep_password'));
        $cookieJar->queue(Cookie::forget('keep_usertype'));
        $cookieJar->queue(Cookie::forget('keep_me_active'));
        return Redirect::route('login');
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
            return redirect::route('profile_edit')->with('success','Profile updated succesffully!');
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
        $data['email_key']      = '';
        
        $data['keyword']            = $request->keyword;
        $data['registerdate']       = $request->registerdate;
        $data['status']             = $request->status;
        $data['email_key']          = $request->email_key;
        $data['lists']              = User::where('id','<>',\Auth::guard('users')->user()->id)
                                            ->where(function($query) use ($data) {
                                              if($data['keyword'] != '' || $data['status'] != '' || $data['registerdate'] != '' || $data['email_key']!=''){
                                                    if($data['keyword'] != ''){
                                                        $query->where('name','like','%'.$data['keyword'].'%');
                                                       
                                                    }
                                                    if($data['email_key'] != ''){
                                                        $query->orWhere('email','like','%'.$data['email_key'].'%');
                                                    }
                                                    if($data['status'] != ''){
                                                        if($data['status'] == 'accepted'){
                                                            $query->where('is_active',1);
                                                        }elseif($data['status'] == 'rejected'){
                                                            $query->where('is_deleted',1);
                                                        }
                                                    }
                                                    if($data['registerdate'] != ''){
                                                        $query->whereRaw("DATE_FORMAT(updated_at, '%m/%d/%Y')='".$data['registerdate']."'");
                                                    }
                                            }else{
                                                $query->where('is_active',0);
                                            }
                                        })
                                        ->orderBy('id','asc')
                                        //->toSql();
                                        //dd($data);die;
                                        ->paginate(10);


        return view('user.list',$data);
    }
    
    public function role_assign($id){
        $data               = array();
        
        $data['users']      = User::find($id);
        $data['usertype']   = Usertype::pluck('type','id')->all();
        $data['prev_url']   = \URL::previous() ;
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
            return redirect::to($request->prev_url)->with('success','Profile updated succesffully!');
            //return redirect::route('user_list')->with('success','Profile updated succesffully!');
        }
    }
}
