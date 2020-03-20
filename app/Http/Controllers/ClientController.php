<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Ticket;
use App\User;

class ClientController extends Controller
{
    public function index(){
        if(Auth::user()->user_type!='client')
            return redirect()->route('admin');
        else
            $user_id = Auth::user()->id;
            $user = User::find($user_id); //where sender==auth:user//   
            return view('client')->with('tickets', $user->tickets);
    }
}
