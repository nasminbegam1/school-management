<?php namespace App\Http;
use \Route, \Config;
use App\User;

class Helpers {
    
    public static function pending_user(){
	return User::where('is_active',0)->get();
    }
} //Class