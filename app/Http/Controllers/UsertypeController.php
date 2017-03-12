<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Usertype , App\User;

use Validator, Redirect;
class UsertypeController extends Controller
{
    public function index(Request $request){
        $data                   = array();
        $data['keyword']        = '';
        if($request->keyword !=''){
            $data['keyword']            = $request->keyword;
            $data['lists']              = Usertype::where('is_deleted',0)->where(function($query) use ($data) {
                                                if($data['keyword'] != ''){
                                                $query->where('type','like','%'.$data['keyword'].'%');
                                                }
                                            })
                                            ->orderBy('type','asc')->paginate(15);
        }
        else{
            $data['lists']      = Usertype::where('is_deleted',0)->orderBy('type','asc')->paginate(15);
        }
        return view('usertype.index',$data);
    }
    
    public function create(){
        $data               = array();
        return view('usertype.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),
                                     ['type'         => 'required|unique:usertypes']);
        if($validator->fails()){
            $message = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $usertype                 = new Usertype;
            $usertype->type           = $request->type;
            $usertype->is_deleted     = 0;
            $usertype->save();
            return Redirect::route('usertype_list')->with('success','Usertype Added Successfully!');
        }
    }
    
    public function edit($id){
        $data['details']    = Usertype::find($id);
        return view('usertype.edit',$data);
    }
    
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),
                                     ['type'         => 'required|unique:usertypes,type,'.$id]);
        if($validator->fails()){
            $message = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $usertype                 = Usertype::find($id);
            $usertype->type           = $request->type;
            $usertype->save();
            return Redirect::route('usertype_list')->with('success','Usertype Updated Successfully!');
        }
    }
    
    public function delete($id){
        if(User::where('school_user_type_id',$id)->count() > 0 ){
        return Redirect::route('usertype_list')->with('error','Cann\'t delete this user type'); 
        }else{
        $usertype             = Usertype::find($id);
        $usertype->is_deleted = 1;
        $usertype->save();
        return Redirect::route('usertype_list')->with('success','Usertype Deleted Successfully!');
        }
    }
}
