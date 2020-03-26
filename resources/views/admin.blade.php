@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- include sidebar --}}
    <div class="jumbotron jumbotron-fluid">
        <h2>Hi {{Auth::user()->name}}!</h2>
        {{-- <span>Share your knowledge!</span> --}}
    </div>
    <div>
      <h3>Tickets</h3>
      <table class="datatables display stripe hover nowrap">
            <thead>
              <tr>
                <th>Ticket ID</th>
                <th>Date Created</th>
                <th>Description</th>
                <th>Status</th>
                <th>Assigned to</th>
                <th>Importance</th>
                <th>Action</th>
            </tr>
            </thead>
            @foreach($tickets->sortByDesc('created_at') as $ticket)
            @if($ticket->status != 'Deleted')
            {{-- $ticket->status != 'Solved' &&  --}}
               <tr>
                  <td>{{ $ticket->id}}</td>
                  <td>{{ $ticket->created_at}}</td>
                  <td>{{ $ticket->title }}</td>
                  <td>{{ $ticket->status }}</td>
                  @if($ticket->assignedto == Auth::user()->name)
                    <td>You</td>
                  @else
                  <td>{{ $ticket->assignedto }}</td>
                  @endif
                  <td>{{ $ticket->importance }}</td>
                  <td>
                    <a href="/thread/{{$ticket->id}}" class="btn btn-primary">Thread</a>
                    @if($ticket->assignedto == Auth::user()->name && $ticket->status != 'Solved')
                      <a href="/return/{{$ticket->id}}" class="btn btn-danger">Return</a>
                    @elseif($ticket->assignedto == NULL && $ticket->status != "Solved")
                      <a href="/pickup/{{$ticket->id}}" class="btn btn-primary">Pickup</a>
                    @elseif($ticket->status = "Solved")
                        
                    @endif
                    </td>
               </tr>
            @endif
            @endforeach
        </table>
    </div>
    </div>
@endsection
