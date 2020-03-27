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
                        <p>{!! $thr->desc !!}</p>
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
        @foreach ($thr->comments->sortByDesc('created_at') as $comment)
        @if($comment->sender_type != "Bot")
        <div class="card">
            <div class="card-header">
                <h4>
                @if($comment->sender == Auth::user()->name)
                    You
                @else    
                    {{$comment->sender}} ( <em>{{$comment->sender_type}}</em> )
                @endif
                </h4>
            </div>
            <div class="card-body">
                <h6 class="card-title">{{$comment->created_at}}</h6>
                <p class="card-text">
                    @if($comment->solution == "true")
                        &#x1f947;
                    @endif
                    {!! $comment->comment !!}
                </p>
                @if($thr->status != "Solved" && $thr->user_id == Auth::user()->id)
                    <a class="btn btn-primary" href="/solved/{{$thr->id}}/{{$comment->id}}">Eureka</a>
                @endif
            </div>
          </div>
          @else 
          <div class="card" style="background-color: #5b5656; color: white">
            <div class="card-header">
                <h3>{{$comment->sender}} ({{$comment->sender_type}})</h3>
            </div>
            <div class="card-body">
               <strong>{{$comment->created_at}}</strong>  {!! $comment->comment !!}
            </div>
          </div>
          @endif
        @endforeach
    </div>
@endsection
@push('com')
    <script>
        $(document).ready(function(){
        CKEDITOR.replace('comment');
        CKEDITOR.replace('desc');
    })
    </script>
@endpush