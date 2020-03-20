@extends('home')

@section('subcontent')
   <div class="jumbotron jumbotron-fluid">
      <h2>Hello {{Auth::user()->name}}</h2>
      <a href="/create-ticket">Create a Ticket </a>
   </div>
   <div class="datatables">
      <table>
          <legend>Tickets</legend>
          <tr>
              <th>Ticket ID</th>
              <th>Date Created</th>
              <th>Topic</th>
              <th>Status</th>
              <th>Importance</th>
              <th>Action</th>
          </tr>
         @foreach($tickets as $ticket)
            @if($ticket->creator == Auth::user()->name)
            <tr>
               <td>{{ $ticket->ticket_id}}</td>
               <td>{{ $ticket->created_at}}</td>
               <td>{{ $ticket->title }}</td>
               <td>{{ $ticket->status }}</td>
               <td>{{ $ticket->importance }}</td>
               <td><button>expand</button>
               <button>modify</button></td>
            </tr>
            @endif
         @endforeach
      </table>
  </div>   
@endsection