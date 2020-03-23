@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <h1>{{$thr->importance}} : {{$thr->title}}</h1>
            <h4>Status: {{$thr->status}}</h4>
            <p><em>{{$thr->desc}}</em></p>
            @if($thr->assignedto == Auth::user()->name)
                <br><a href="#">Edit</a> 
                {{--modal-on-submit =======> /editposst/{{$thr->id}} --}}
                <a href="/deletepost">Delete</a><br>
            @elseif(Auth::user()->id == $thr->user_id)
                <a href="/editcontent">Edit</a><br>
            @endif
            <span>Issued: {{$thr->created_at}}</span><br>
            <span>Modified: {{$thr->updated_at}}</span>
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
        @foreach ($thr->comments as $comment)
            <div class="comment">
                <h4>
                    @if($comment->sender == Auth::user()->name)
                        You
                    @else    
                        {{$comment->sender}} ( <em>{{$comment->sender_type}}</em> )
                    @endif
                </h4>
                <span>{{$comment->comment}}</span>
                <hr>
            </div>
        @endforeach
    </div>
@endsection