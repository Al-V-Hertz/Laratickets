<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Ticket;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Route;
class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {   
        $ticket = Ticket::find($id);

        return view('/thread')->with('thr', $ticket);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editpost($id)
    {
        $ticket = Ticket::find($id);
        if($ticket->status == "Solved"){
            $ticket->status = "Reopened";
            $ticket->save();
        }
        return view('editpost')->with('thr', $ticket);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function editstore(Request $request, $id)
    {
        $edithread = Ticket::find($id);
        $edithread->title = $request->input('title');
        $edithread->desc = $request->input('desc');
        $edithread->importance = $request->input('importance');
        $edithread->save();
        return redirect('/thread/'.$request->input('id'));
    }

    public function deletepost($id)
    {
        $delthread = Ticket::find($id);
        $delthread->status = "Deleted";
        $delthread->save();
        return redirect('/client');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
