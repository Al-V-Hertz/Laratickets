@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- include sidebar --}}
    <div class="jumbotron jumbotron-fluid">
        <h2>Hi {{Auth::user()->name}}!</h2>
        {{-- <span>Share your knowledge!</span> --}}
    </div>
    <div class="datatables">
        <table class ="table table-striped">
            <legend>Tickets</legend>
            <tr>
                <th>Ticket ID</th>
                <th>Date Created</th>
                <th>Description</th>
                <th>Status</th>
                <th>Assigned to</th>
                <th>Importance</th>
                <th>Action</th>
            </tr>
            @foreach($tickets as $ticket)
               <tr>
                  <td>{{ $ticket->ticket_id}}</td>
                  <td>{{ $ticket->created_at}}</td>
                  <td>{{ $ticket->title }}</td>
                  <td>{{ $ticket->status }}</td>
                  @if($ticket->assignedto == Auth::user()->name)
                    <td>You</td>
                  @else
                  <td>{{ $ticket->assignedto }}</td>
                  @endif
                  <td>{{ $ticket->importance }}</td>
                  <td><a href="#" class="btn btn-primary">Thread</a>
                    @if($ticket->assignedto == Auth::user()->name)
                        <a href="#" class="btn btn-primary">Modify</a>
                        <a href="#" class="btn btn-danger">Return</a>
                    @elseif($ticket->assignedto == NULL)
                        <a href="" class="btn btn-primary">Pickup</a>
                    @endif
                    </td>
               </tr>
            @endforeach
        </table>
    </div>
    </div>
@endsection