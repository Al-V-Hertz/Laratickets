<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Ticket;

class ClientController extends Controller
{
    public function index(){
        if(Auth::user()->user_type!='client')
            return redirect()->route('admin');
        else
            $tickets = Ticket::all(); //where sender==auth:user//   
            return view('client')->with('tickets', $tickets);
    }
}
