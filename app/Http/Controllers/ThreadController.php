<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Route;
class ThreadController extends Controller
{
    
    public function index($id)
    {   
        $ticket = Ticket::find($id);

        return view('/thread')->with('thr', $ticket);
    }

    public function editpost($id)
    {
        $ticket = Ticket::find($id);
        if($ticket->status == "Solved"){
            $ticket->status = "Reopened";
            $ticket->save();
        }
        return view('editpost')->with('thr', $ticket);
    }

    public function store(Request $request)
    {
        $newThr = new Thread();
        $newThr->ticket_id = $request->input('ticket-id');
        $newThr->sender = Auth::user()->name;
        $newThr->sender_type = Auth::user()->user_type;
        $newThr->comment = $request->input('comment');
        $newThr->save();
        return redirect('/thread/'.$request->input('ticket-id'));
    }

    public function deletepost($id)
    {
        $delthread = Ticket::find($id);
        $delthread->status = "Deleted";
        $delthread->save();
        return redirect('/client');
    }

}
