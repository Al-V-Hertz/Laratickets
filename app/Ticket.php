<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    // protected $dateFormat = 'U';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
