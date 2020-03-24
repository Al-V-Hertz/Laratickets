@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <h1><strong>{{$thr->importance}}</strong> : {{$thr->title}}</h1>
            <h4>Status: <strong>{{$thr->status}}</strong></h4>
            <p><em>{{$thr->desc}}</em></p>
            <span>Issued: {{$thr->created_at}}</span><br>
            <span>Modified: {{$thr->updated_at}}</span>

            @if($thr->assignedto == Auth::user()->name && $thr->status !="Solved")
                <br><br><a href="/editpost/{{$thr->id}}">Edit</a><br>
            @elseif(Auth::user()->id == $thr->user_id && $thr->status != "Solved") 
                {{-- only ticket creator can delete --}}
                <br><br><a href="/editpost/{{$thr->id}}">Edit</a>
                <a href="/deletepost/{{$thr->id}}">Delete</a><br>
            @elseif($thr->status == "Solved" && Auth::user()->name == $thr->assignedto || Auth::user()->id == $thr->user_id)
                <br><br><a href="/editpost/{{$thr->id}}">Reopen</a><br>
            @endif

        </div>
        <form method="POST" action="/add-thread">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Add Comment</label>
                <input type="hidden" name="ticket-id" value="{{$thr->id}}">
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
        <hr>
        <h2>Comments</h2>
        @if($thr->status == "Solved")
            <div class="alert alert-primary">Ticket was <strong>Resolved</strong></div>
        @elseif($thr->status == "Reopened")
            <div class="alert alert-primary">Ticket was <strong>Resolved</strong></div>
            <div class="alert alert-primary">Ticket was <strong>Reopened</strong></div>
        @elseif($thr->status == "Deleted")
            <div class="alert alert-danger">Ticket was <strong>Deleted</strong></div>
        @endif
        @foreach ($thr->comments->sortByDesc('created_at') as $comment)
            <div class="comment">
                <form>
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                </form>
                <h4>
                    @if($comment->sender == Auth::user()->name)
                        You
                    @else    
                        {{$comment->sender}} ( <em>{{$comment->sender_type}}</em> )
                    @endif
                </h4><sup>{{$comment->created_at}}</sup>
                <p>
                    @if($comment->solution == "true")
                        &#x1f947;
                    @endif
                    {{$comment->comment}}</p>
                @if($thr->status != "Solved" && $thr->user_id == Auth::user()->id)
                    <span><a href="/solved/{{$comment->id}}">Eureka</a></span>
                @endif
                <hr>
            </div>
        @endforeach
    </div>
@endsection