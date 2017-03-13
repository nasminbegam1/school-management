<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schoolmodule extends Model
{
	protected $table = 'School_Modules';
    public function module(){
        return $this->belongsTo('App\Module','module_id','id');
    }
    
    public function school(){
        return $this->belongsTo('App\School','school_id','ID');
    }
}
