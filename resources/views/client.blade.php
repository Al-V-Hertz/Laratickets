@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="jumbotron jumbotron-fluid">
         <h2>Hello {{Auth::user()->name}}</h2>
         <a href="/create-ticket">Create a Ticket </a>
      </div>
      <div class="table table-striped">
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
               <tr>
                  <td>{{ $ticket->ticket_id}}</td>
                  <td>{{ $ticket->created_at}}</td>
                  <td>{{ $ticket->title }}</td>
                  <td>{{ $ticket->status }}</td>
                  <td>{{ $ticket->importance }}</td>
                  <td><a href="/thread/{{$ticket->id}}" class="btn btn-primary">Thread</a></td>
                  {{-- <a href="#" class="btn btn-primary">Modify</a></td> --}}
               </tr>
            @endforeach
         </table>
     </div>   
   </div>
@endsection