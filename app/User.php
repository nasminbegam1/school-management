<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends \Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    protected $table = 'School_User';
    public function setPasswordAttribute($password){   
        $this->attributes['password'] = bcrypt($password);
    }
    public function usertype(){
        return $this->belongsTo('App\Usertype','school_user_type_id');
    }
}
