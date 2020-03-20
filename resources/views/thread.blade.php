@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <h1>{{$ticket->title}}</h1>
            <p>{{$ticket->desc}}</p>
        </div>
        <form action="/addtickets">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Add Comment</label>
                <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <a href="/add-thread" class="btn btn-primary">Submit</a>
        </form>
        <hr>

    </div>
@endsection