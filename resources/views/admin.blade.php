@extends('home')

@section('subcontent')
    {{-- include sidebar --}}
    <div class="jumbotron jumbotron-fluid">
        <h2>Hi {{Auth::user()->name}}!</h2>
        {{-- <span>Share your knowledge!</span> --}}
    </div>
    <div class="datatables">
        <table>
            <legend>Tickets</legend>
            <tr>
                <th>Ticket ID</th>
                <th>Description</th>
                <th>Status</th>
                <th>Assigned to</th>
                <th>Importance</th>
                <th>Action</th>
            </tr>
            
            {{-- @forelse() --}}
        </table>
    </div>
@endsection
