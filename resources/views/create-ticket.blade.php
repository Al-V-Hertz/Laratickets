@extends('home')

@section('content')
<div class="create" style="width: 1000px; margin: auto">
    <form action="/addtickets">
        <div class="form-group">
          <label for="exampleFormControlInput1">Ticket ID</label>
          <input name="ticket_id" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Importance</label>
          <select name="importance" class="form-control" id="exampleFormControlSelect1">
            <option>Urgent</option>
            <option>High</option>
            <option>Low</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection