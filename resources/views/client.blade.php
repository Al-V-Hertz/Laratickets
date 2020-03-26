@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="jumbotron jumbotron-fluid">
         <h2>Hello {{Auth::user()->name}}</h2>
         <a href="/create-ticket">Create a Ticket </a>
      </div>
      <div>
         <h3>My Tickets</h3>
         <table class="datatables display stripe hover nowrap">
             <thead>
               <tr>
                  <th>Ticket ID</th>
                  <th>Date Created</th>
                  <th>Topic</th>
                  <th>Status</th>
                  <th>Importance</th>
                  <th>Action</th>
              </tr>
             </thead>
            <tbody>
               @foreach($tickets->sortByDesc('created_at') as $ticket)
               @if($ticket->status !='Deleted')
               <tr>
                  <td>{{ $ticket->id}}</td>
                  <td>{{ $ticket->created_at}}</td>
                  <td>{{ $ticket->title }}</td>
                  <td>{{ $ticket->status }}</td>
                  <td>{{ $ticket->importance }}</td>
                  <td>
                     <a href="/thread/{{$ticket->id}}" class="btn btn-primary">Thread</a>
                     @if($ticket->status != "Solved")
                        <a href="/solved/{{$ticket->id}}" class="btn btn-info">Mark Solved</a>
                     @endif
                  </td>
               </tr>
               @endif
            @endforeach
            </tbody>
         </table>
     </div>   
   </div>
@endsection