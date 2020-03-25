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
    public function solved($id)
    {   
        if(URL::previous() == URL::to('/')."/client"){
            $solTicket = Ticket::find($id);
            $solTicket->status = "Solved";
            $solTicket->save();
            return redirect("/client");
        }
        else if(URL::previous() == URL::to('/')."/thread/".$id){
            $comment = Thread::find($id);
            $comment->solution = "true";
            $ticket = Ticket::find($comment->ticket_id);
            $ticket->status = "Solved";
            $comment->save();
            $ticket->save();
            return redirect('/thread/'.$id);
        }
        else{
            return redirect("/client");
        }
        // $sol = Ticket::find($id);
        // $com = Thread::find($id);
        // dd($id);
        // dd( URL::previous());
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
        return redirect('/client');
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
}
