<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    public function module(){
        return $this->belongsTo('App\Module','modules_id');
    }
}
