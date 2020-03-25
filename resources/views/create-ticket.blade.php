@extends('layouts.app')

@section('content')
<div class="create" style="width: 1000px; margin: auto">
    <form action="/addtickets" method="POST">
      
      @csrf
        <div class="form-group">
          <label for="exampleFormControlInput1">Ticket ID</label>
          <input id="ticket_id" name="ticket_id" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input id="title" name="title" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea id="desc" name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Importance</label>
          <select id="importance" name="importance" class="form-control" id="exampleFormControlSelect1">
            <option>Urgent</option>
            <option>High</option>
            <option>Low</option>
          </select>
        </div>
        <button id="addtick" type="submit" class="btn btn-primary">Submit</button>
      </form>
</div>
@endsection

@section('jquery')
    <script>
      $(document).ready(function(){
        $.ajaxSetup({
			      headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			      }
		    });
        $("#addtick").click(function(){
          $ticket_id=$("#ticket_id").val();
          $title=$("#title").val();
          $desc=$("#desc").val();
          $importance=$("#importance").val();
          $.ajax({
               type:'POST',
               url:'/addtickets',
               data: {
                 ticket_id : ticket_id,
                 title : title,
                 desc : desc,
                 importance : importance
               };
              //  success: function(data) {
              //     alert('Success');
              //  };
            });
        });
      });
    </script>
@endsection