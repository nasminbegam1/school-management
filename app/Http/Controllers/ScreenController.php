<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Module , App\Screen;
use Validator, Redirect;

class ScreenController extends Controller
{
    public function index(Request $request){
        $data                   = array();
        $data['keyword']        = '';
        if($request->keyword !=''){
            $data['keyword']            = $request->keyword;
            $data['lists'] = Screen::where('is_deleted',0)->where(function($query) use ($data) {
                                if($data['keyword'] != ''){
                                $query->where('screen_name','like','%'.$data['keyword'].'%');
                                }
                            })
                            ->orderBy('screen_name','asc')->paginate(15);
        }
        else{
            $data['lists']      = Screen::where('is_deleted',0)->orderBy('screen_name','asc')->paginate(15);
        }
        return view('screen.index',$data);
    }
    
    public function create(){
        $data               = array();
        $data['module']     = Module::pluck('module_name','id')->all();
        return view('screen.create',$data);
    }
    
    public function store(Request $request){
        $validator = Validator::make($request->all(),
                                     ['module'              => 'required',
                                      'screen_name'         => 'required']);
        if($validator->fails()){
            $message = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $screen                 = new Screen;
            $screen->modules_id     = $request->module;
            $screen->screen_name    = $request->screen_name;
            $screen->is_deleted     = 0;
            $screen->save();
            return Redirect::route('screen_list')->with('success','Screen Added Successfully!');
        }
    }
    
    public function edit($id){
        $data['details']    = Screen::find($id);
        $data['module']     = Module::pluck('module_name','id')->all();
        return view('screen.edit',$data);
    }
    
    public function update(Request $request,$id){
        $validator = Validator::make($request->all(),
                                     ['module'              => 'required',
                                      'screen_name'         => 'required']);
        if($validator->fails()){
            $message = $validator->messages();
            return Redirect::back()->withErrors($validator)->withInput();
        }else{
            $screen                 = Screen::find($id);
            $screen->modules_id     = $request->module;
            $screen->screen_name    = $request->screen_name;
            $screen->save();
            return Redirect::route('screen_list')->with('success','Screen Updated Successfully!');
        }
    }
    
    public function delete($id){
        $screen             = Screen::find($id);
        $screen->is_deleted = 1;
        $screen->save();
        return Redirect::route('screen_list')->with('success','Screen Deleted Successfully!');
    }
}
