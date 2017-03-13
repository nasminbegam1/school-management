<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usertype extends Model
{
	protected $table ='School_User_Type';	
    public function user(){
        return $this->hasMany('App\User','school_user_type_id');
    }
}
