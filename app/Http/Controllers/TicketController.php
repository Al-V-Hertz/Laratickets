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
    public function log($tid, $status, $who, $type)
    {
        // returned, reopened, pick up, solved, deleted, unassigned
        if($status == "Pending")
        {
            $status = "Picked Up";
        }elseif($status == "Solved"){
            $status == "Marked Solved";
        }
        $log = new Thread();
        $log->ticket_id = $tid;
        $log->sender = "Acacia";
        $log->sender_type = "Bot";
        $log->comment = "Ticket was ".$status." by ".$type.": ".$who;
        $log->save();
    }

    public function solved($tid, $cid)
    {   
        $ticket = Ticket::find($tid);
        if(URL::previous() == URL::to('/')."/client"){
            $ticket->status = "Solved";
            $ticket->save();
            $this->log($tid, $ticket->status, Auth::user()->name, Auth::user()->user_type);
            return redirect("/client");
            // dd($id);
        }
        else if(URL::previous() == URL::to('/').'/thread/'.$tid){
            $comment = Thread::find($cid);
            $comment->solution = "true";
            $ticket->status = "Solved";
            $comment->save();
            $ticket->save();
            $this->log($tid, $ticket->status, Auth::user()->name, Auth::user()->user_type);
            return redirect('/thread/'.$tid);
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
        $this->log($newTicket->id, "Created", Auth::user()->name, Auth::user()->user_type);
    }
   
    public function index(){
        return view('create-ticket');
    }

    public function pickup($id){
        $updTicket = Ticket::find($id);
        $updTicket->assignedto = Auth::user()->name;
        $updTicket->status = 'Pending';
        $updTicket->save();
        $this->log($id, $updTicket->status, Auth::user()->name, Auth::user()->user_type);
        return redirect('/client');
    }

    public function return($id){
        $updTicket = Ticket::find($id);
        $updTicket->assignedto = '';
        $updTicket->status = 'Returned';
        $updTicket->save();
        $this->log($id, $updTicket->status, Auth::user()->name, Auth::user()->user_type);
        return redirect('/client');
    }
    
    public function editstore(Request $request, $id)
    {
        $edit = Ticket::find($id);
        $edit->title = $request->input('title');
        $edit->desc = $request->input('desc');
        $edit->importance = $request->input('importance');
        $edit->save();
        $this->log($id, "Modified", Auth::user()->name, Auth::user()->user_type);
        return redirect('/thread/'.$request->input('id'));
    }
}
