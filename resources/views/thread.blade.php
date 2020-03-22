@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <h1>{{$thr->title}}</h1>
            <p>{{$thr->desc}}</p>
        </div>
        <form method="POST" action="/add-thread">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Add Comment</label>
                <input type="hidden" name="ticket-id" value="{{$thr->ticket_id}}">
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
                        {{$comment->sender_type}}: {{$comment->sender}}
                    @endif
                    {{$comment->sender}}
                </h4>
                <p>{{$comment->comment}}</p>
            </div>
        @endforeach
    </div>
@endsection