<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    public function screen(){
        return $this->hasMany('App\Screen','modules_id');
    }
    
    public function school_module(){
        return $this->hasMany('App\Schooolmodule','module_id','id');
    }
}
