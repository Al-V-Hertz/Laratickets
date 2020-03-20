<?php

namespace App\Http\Controllers;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function store(Request $request){
        $newTicket = new Ticket();
        $newTicket->user_id = Auth::user()->id;
        $newTicket->ticket_id = $request->input('ticket_id');
        $newTicket->title = $request->input('title');
        $newTicket->desc = $request->input('desc');
        // $newTicket->status = $request->input('status');
        $newTicket->assignedto = $request->input('assignedto');
        $newTicket->importance = $request->input('importance');
        $newTicket->save();
        return redirect()->route('client');
    }
    // public function show(){
    //     $user_id = Auth::user()->id;
    //     $user = User::find($user_id)->paginate(15); //where sender==auth:user//   
    //     return view('client')->with('tickets', $user->ticket);
    // }
    public function index(){
        return view('create-ticket');
    }
}
