<?php

namespace App\Http\Controllers;
use App\Ticket;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
class TicketController extends Controller
{
    public function solved($tid, $cid)
    {   
        $ticket = Ticket::find($tid);
        if(URL::previous() == URL::to('/')."/client"){
            $ticket->status = "Solved";
            $ticket->save();
            return redirect("/client");
            // dd($id);
        }
        else if(URL::previous() == URL::to('/').'/thread/'.$tid){
            $comment = Thread::find($cid);
            $comment->solution = "true";
            $ticket->status = "Solved";
            $comment->save();
            $ticket->save();
            return redirect('/thread/'.$tid);
            // dd($id);
        }
    }
    
    public function store(Request $request){
        $newTicket = new Ticket();
        $newTicket->user_id = Auth::user()->id;
        $newTicket->ticket_id = $request->ticket_id;
        $newTicket->title = $request->title;
        $newTicket->desc = $request->desc;
        $newTicket->importance = $request->importance;
        $newTicket->save();
        // dd($request);
        // return redirect('/client');
        // return $request->title;
    }
   
    public function index(){
        return view('create-ticket');
    }

    public function pickup($id){
        $updTicket = Ticket::find($id);
        $updTicket->assignedto = Auth::user()->name;
        $updTicket->status = 'Pending';
        $updTicket->save();
        return redirect('/client');
    }

    public function return($id){
        $updTicket = Ticket::find($id);
        $updTicket->assignedto = '';
        $updTicket->status = 'Returned';
        $updTicket->save();
        return redirect('/client');
    }
    
    public function editstore(Request $request, $id)
    {
        $edit = Ticket::find($id);
        $edit->title = $request->input('title');
        $edit->desc = $request->input('desc');
        $edit->importance = $request->input('importance');
        $edit->save();
        return redirect('/thread/'.$request->input('id'));
    }
}
