<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function set_email(){
        return $this->belongsTo('App\SetEmail');
    }
}
