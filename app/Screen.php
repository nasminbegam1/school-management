<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
	protected $table = 'Screen_Master';
    public function module(){
        return $this->belongsTo('App\Module','modules_id');
    }

    public function parent(){
        return $this->belongsTo('App\Screen','parent_id','id');
    }
    public function child(){
        return $this->hasMany('App\Screen','parent_id','id');
    }
}
