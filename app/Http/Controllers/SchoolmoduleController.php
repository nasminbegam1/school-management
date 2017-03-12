<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \App\School, \App\Module, \App\Schoolmodule;
use \Redirect;

class SchoolmoduleController extends Controller
{
    public function index(Request $request){
        $data['school_lists'] = array();
        $lists = Schoolmodule::groupBy('school_id')->select('school_id')->get();
        foreach($lists as $i=>$l){
             $school_id = $l->school_id;
            $modules = Schoolmodule::where('school_id',$school_id)->where('is_deleted',0)->get();
            $data['school_lists'][] = [
                                       'sr_no' => ($i+1),
                                       'id'     => $school_id,
                                       'school_name'=>School::where('ID',$school_id)->first()->School_Name,
                                       'modules' => $modules
                                       ];
        }
       // dd($data);
        $data['keyword'] = $request->keyword;
        return view('school.module',$data);
    }
    
    public function add(){
        $data['school_lists'] = School::where('Is_Deleted',0)->lists('School_Name','ID');
        $data['module_lists'] = Module::where('is_active',1)->lists('module_name','ID');
        return view('school.module_add',$data);
    }
    public function store(Request $request){
        $school_id = $request->school;
        $modules = $request->module_id;
        foreach($modules as $m){
            $new_s_module = new Schoolmodule;
            $new_s_module->school_id = $school_id;
            $new_s_module->module_id = $m;
            $new_s_module->is_active = 1;
            $new_s_module->save();
        }
        
        return Redirect::route('school_modlues')->with('succMsg','School Module is added Successfully');
        
    }
    
    public function edit($id){
        $data['module_lists'] = Module::where('is_active',1)->lists('module_name','ID');
        $data['school_details'] = School::where('ID',$id)->first();
        $data['selected_modules'] = Schoolmodule::where('school_id',$id)->where('is_deleted',0)->lists('module_id')->toArray();
        //dd($data);
        return view('school.module_edit',$data);
    }
    
    public function update(Request $request,$id){
        
        $school_id = $request->school;
        $modules = $request->module_id;
        $remove_modules = $request->uncheck_module_id;
        if($modules && count($modules) >0){
            foreach($modules as $m){
                $check = Schoolmodule::where('school_id',$id)->where('module_id',$m)->first();
                if($check==null){
                    $new_s_module = new Schoolmodule;
                    $new_s_module->school_id = $id;
                    $new_s_module->module_id = $m;
                    $new_s_module->is_active = 1;
                    $check->is_deleted = 0;
                    $new_s_module->save();
                }else{
                    $check->is_deleted = 0;
                    $check->save();
                }
            }
        }
        if($remove_modules && count($remove_modules) >0){
            foreach($remove_modules as $m){
                $check = Schoolmodule::where('school_id',$id)->where('module_id',$m)->first();
                if(count($check)>0){
                    $check->is_deleted = 1;
                    $check->save();
                }
            }
        }
        
        return Redirect::route('school_modlues')->with('succMsg','School Module is added Successfully');
        
    }
}
