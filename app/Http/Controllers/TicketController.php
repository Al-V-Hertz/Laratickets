<?php

namespace App\Http\Controllers;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function store(Request $request){
        $newTicket = new Ticket();
        $newTicket->creator = Auth::user()->id;
        $newTicket->ticket_id = $request->input('ticket_id');
        $newTicket->title = $request->input('title');
        $newTicket->desc = $request->input('desc');
        // $newTicket->status = $request->input('status');
        $newTicket->assignedto = $request->input('assignedto');
        $newTicket->importance = $request->input('importance');
        $newTicket->save();
        return redirect()->route('client');
    }
    public function show(){
        $tickets = Ticket::all(); //where sender==auth:user//   
        return view('client')->with('tickets', $tickets);
    }
    public function index(){
        return view('create-ticket');
    }
}
