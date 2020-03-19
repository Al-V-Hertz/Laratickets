@extends('home')

@section('subcontent')
   <div class="jumbotron jumbotron-fluid">
      <h2>Hello {{Auth::user()->name}}</h2>
      <button id='create_ticket'>Create a Ticket</button>
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
          {{-- @forelse() --}}
      </table>
  </div>   
@endsection