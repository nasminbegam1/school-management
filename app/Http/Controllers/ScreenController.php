<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
//use App\Module;

class ScreenController extends Controller
{
    public function index(){
        $data = array();
        return view('screen.index',$data);
    }
    
    public function create(Request $request){
        $data = array();
        //$data['module'] = Module::pluck('module_name','id')->all();
        return view('screen.create',$data);
    }
}
