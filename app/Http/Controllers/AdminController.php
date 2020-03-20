<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Ticket;


class AdminController extends Controller
{
    public function index(){
        if(Auth::user()->user_type!='admin')
            return redirect()->route('client');
        else
        $tickets = Ticket::all(); //where sender==auth:user//   
        return view('admin')->with('tickets', $tickets);
    }
}
