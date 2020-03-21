@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <h1>{{$ticket->title}}</h1>
            <p>{{$ticket->desc}}</p>
        </div>
        <form method="POST" action="/add-thread">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Add Comment</label>
                <input type="hidden" name="ticket-id" value="{{$ticket->id}}">
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
        <hr>
        <h2>Comments</h2>
        {{-- @foreach ($collection as $item)
            
        @endforeach --}}
    </div>
@endsection