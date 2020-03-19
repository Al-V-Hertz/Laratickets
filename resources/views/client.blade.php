@extends('home')

@section('subcontent')
   <div class="jumbotron jumbotron-fluid">
      <h2>Hello {{Auth::user()->name}}</h2>
      <a href="/create-ticket"><button id='create_ticket'>Create a Ticket</button></a>
   </div>
   <div class="datatables">
      <table>
          <legend>Tickets</legend>
          <tr>
              <th>Ticket ID</th>
              <th>Description</th>
              <th>Status</th>
              <th>Importance</th>
              <th>Action</th>
          </tr>
         {{-- @foreach($tickets as $ticket)
            <tr>
               <td>{{ $ticket->ticket_id }}</td>
               <td>{{ $ticket->desc }}</td>
               <td>{{ $ticket->title }}</td>
               <td>{{ $ticket->status }}</td>
               <td>{{ $ticket->importance }}</td>
               <td></td>
            </tr>
         @endforeach --}}
      </table>
  </div>   
@endsection