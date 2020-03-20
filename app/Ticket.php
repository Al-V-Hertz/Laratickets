<?php

namespace App;
use App\User;
use App\Thread;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    // protected $dateFormat = 'U';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Thread');
    }
}
