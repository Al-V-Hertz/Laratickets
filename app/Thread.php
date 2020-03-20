<?php

namespace App;
use App\Ticket;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //

    public function ticket(){
        return $this->belongsTo('App\Ticket');
    }
}
