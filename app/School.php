<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $connection = 'mysql_school';
    protected $table = 'School';
    
    public function modules(){
        return $this->hasMany('App\Schoolmodule','school_id','ID');
    }
}
