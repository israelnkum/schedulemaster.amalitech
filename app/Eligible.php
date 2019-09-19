<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eligible extends Model
{
    protected $fillable = [
        'category_id', 'user_id','booked'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function category(){
        return $this->belongsTo('App\Categories');
    }
}
