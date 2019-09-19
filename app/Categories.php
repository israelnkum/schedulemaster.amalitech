<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function eligible(){
        return $this->hasMany('App\Eligible');
    }

    public function schedules(){
        return $this->hasMany('App\Schedule');
    }
}
