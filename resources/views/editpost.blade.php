@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <form method="POST" action="/submit-edit/{{$thr->id}}">
                @csrf
                  <div class="editdiv">
                    @if($thr->user_id == Auth::user()->id)
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input value="{{$thr->title}}" name="title" type="text" class="form-control" id="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Description</label>
                        <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$thr->desc}}</textarea>
                      </div>
                    @elseif($thr->assignedto == Auth::user()->name)
                        <h1><strong>{{$thr->title}}</h1>
                        <h4>Status: <strong>{{$thr->status}}</strong></h4>
                        <p><em>{{$thr->desc}}</em></p>
                        <span>Issued: {{$thr->created_at}}</span><br><br>
                        <input type="hidden" name="title" value="{{$thr->title}}">
                        <input type="hidden" name="desc" value="{{$thr->desc}}">
                    @endif
                    <div class="form-group">
                       <h3>Importance</h3>
                      <input type="hidden" name="id" value="{{$thr->id}}">
                        <select name="importance" class="form-control" id="exampleFormControlSelect1">
                        <option value="{{$thr->importance}}" selected>{{$thr->importance}}</option>
                        <option>Urgent</option>
                        <option>High</option>
                        <option>Low</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
            </form>
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