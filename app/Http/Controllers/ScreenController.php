<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Module , App\Screen;
use Validator, Redirect, Auth;

class ScreenController extends Controller
{
    public function index(Request $request){
        $data                   = array();
        $routeCollection = \Route::getRoutes();;
        $d =[];
        foreach ($routeCollection as $value) {
            $methods = $value->getMethods();
            if(in_array('GET', $methods) && !in_array('POST', $methods)){
                $group = ltrim($value->getPrefix(),'/');
                $d[] = ['path'      =>   $value->getPath(),
                        'name'      =>  ucfirst( str_replace('_', ' ', $value->getName())),
                        'group_name'=>   $group,
                        'alise'     =>  $value->getName()
                        
                       ];
            }
        }
        $data['lists'] = $d;
        //dd($data['lists']);
        /*$data['keyword']        = '';
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
        }*/
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
    
    public function edit($screen_name){
        //$data['details']    = Screen::find($id);
        $data['module']     = Module::pluck('module_name','id')->all();

        $routeCollection = \Route::getRoutes();;
        $d =[];
        foreach ($routeCollection as $value) {
            $methods = $value->getMethods();
            if(in_array('GET', $methods) && !in_array('POST', $methods)){
                $group = ltrim($value->getPrefix(),'/');
                $d[ $value->getName() ] = ['path'      =>   $value->getPath(),
                        'name'      =>  ucfirst( str_replace('_', ' ', $value->getName())),
                        'group_name'=>   $group,
                        'alise'     =>  $value->getName()
                        
                       ];
            }
        }


        $data['screen_alise_name'] = $screen_name;
        $data['screen_name'] =  $d[$screen_name]['name'];
        $data['group_name']  =  ucfirst( str_replace('-', ' ', $d[$screen_name]['group_name']));
        return view('screen.edit',$data);
    }
    
    public function update(Request $request,$id){
        
            $group = $request->group_name;
            $groupData = Screen::where('screen_name',$request->group_name)->first(); 
            if($groupData == null){
                $groupData = new Screen;
                $groupData->screen_name = $group;
                $groupData->modules_id             = $request->module;
                $groupData->is_active = 1;
                $groupData->updated_by             =\Auth::guard('users')->user()->id;
                $groupData->is_left_visible        = 1;
                $groupData->save();
            }
            $record = Screen::where('screen_alise',$request->screen_alise)->first();
            if($record != null){
                $screen                         = $record;    
            }else{
                $screen                         = new Screen;    
            }
       
            $screen->modules_id             = $request->module;
            $screen->parent_id              = $groupData->id;
            $screen->screen_name            = $request->screen_name;
            $screen->screen_alise           = $request->screen_alise;
            $screen->is_active              = $request->status;
            $screen->is_left_visible        = $request->is_left_visible;
            $screen->updated_by             =\Auth::guard('users')->user()->id;
            $screen->save();
            return json_encode(['status'=>'1']);
        
    }
    
    public function delete($id){
        $screen             = Screen::find($id);
        $screen->is_deleted = 1;
        $screen->save();
        return Redirect::route('screen_list')->with('success','Screen Deleted Successfully!');
    }

    public function editScreen($screen_name){

    }
}
