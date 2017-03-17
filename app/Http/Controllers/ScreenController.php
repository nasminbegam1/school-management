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
                $groupData = Screen::where('screen_alise',$value->getName())->first(); 
                $group = ltrim($value->getPrefix(),'/');
                $d[] = ['path'      =>   $value->getPath(),
                        'name'      =>  ucfirst( str_replace('_', ' ', $value->getName())),
                        'group_name'=>   $group,
                        'alise'     =>  $value->getName(),
                        'status'    =>  (($groupData !=null)?$groupData->is_active:'0'),
                        'module'    =>  (($groupData !=null)?$groupData->module->module_name:'N/A'),
                        'id'        =>  (($groupData !=null)?$groupData->id:''),
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
    

    public function edit($screen_name){
        //$data['details']    = Screen::find($id);
        $data['module']     = Module::pluck('module_name','id')->all();

        $record = Screen::where('screen_alise',$screen_name)->first();
            if($record == null){

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
                $data['modules_id']   = '';
                $data['status']   = '';
                $data['is_left']   = '';
          }else{

                $data['screen_alise_name'] = $record->screen_alise;
                $data['screen_name'] =  $record->screen_name;
                if($record->parent_id != null){
                    $data['group_name']  =  $record->parent->screen_name;    
                }
                $data['modules_id']   = $record->modules_id;
                $data['status']   = $record->is_active;
                $data['is_left']   = $record->is_left_visible;
                
          }
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
            if($request->is_left_visible){
                $screen->is_left_visible        = $request->is_left_visible;    
            }else{
                $screen->is_left_visible        = 0;
            }
            
            $screen->updated_by             =\Auth::guard('users')->user()->id;
            $screen->save();
            return json_encode(['status'=>'1']);
        
    }
    
   
}
