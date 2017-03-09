<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    public function login(){
        $data = array();
        return view('user.login', $data);
    }
}
