<?php

namespace App\Http\Controllers;
use App\Ticket;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function show($id)
    {
        // 
    }
    
    public function store(Request $request){
        $newTicket = new Ticket();
        $newTicket->user_id = Auth::user()->id;
        $newTicket->ticket_id = $request->input('ticket_id');
        $newTicket->title = $request->input('title');
        $newTicket->desc = $request->input('desc');
        $newTicket->assignedto = $request->input('assignedto');
        $newTicket->importance = $request->input('importance');
        $newTicket->save();
        return redirect()->route('client');
    }
   
    public function index(){
        return view('create-ticket');
    }

    public function pickup($id){
        $updTicket = Ticket::find($id);
        $updTicket->assignedto = Auth::user()->name;
        $updTicket->status = 'Pending';
        $updTicket->save();
        return redirect()->route('client');
    }

    public function return($id){
        $updTicket = Ticket::find($id);
        $updTicket->assignedto = '';
        $updTicket->status = 'Returned';
        $updTicket->save();
        return redirect()->route('client');
    }
}
