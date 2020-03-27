@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <h5>ISSUE CODE: {{$thr->ticket_code}}</h5>
            <h1><strong>{{$thr->importance}}</strong> : {{$thr->title}}</h1>
            <h4>Status: <strong>{{$thr->status}}</strong></h4>
            <p><em>{!! $thr->desc !!}</em></p>
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
    })
    </script>
@endpush