@extends('layouts.app')

@section('content')
<div class="create" style="width: 1000px; margin: auto">
        <form>
          {{-- <div class="form-group">
            <label for="exampleFormControlInput1">Ticket ID</label>
            <input id="ticket_id" name="ticket_id" type="text" class="form-control" id="exampleFormControlInput1">
          </div> --}}
          <div class="form-group">
              <label for="exampleFormControlInput1">Title</label>
              <input id="title" name="title" type="text" class="form-control" id="exampleFormControlInput1" required>
          </div>
          <div class="form-group">
              <label for="exampleFormControlTextarea1">Description</label>
              <textarea id="desc" name="desc" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
            </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Importance</label>
            <select id="importance" name="importance" class="form-control" id="exampleFormControlSelect1">
              <option>Urgent</option>
              <option>High</option>
              <option>Low</option>
            </select>
          </div>
          <button id="addtick" type="button" class="btn btn-primary">Submit</button>
        </form>
</div>
@endsection
@push('jquery')
    <script>
       $(document).ready(function(){
        CKEDITOR.replace('desc');
        $("#addtick").click(function(){
          CKEDITOR.instances['desc'].updateElement();
        // var ticket_id = $("#ticket_id").val();
        var title = $("#title").val();
        var desc = $("#desc").val();
        var importance = $("#importance").val();
        $.ajax({
             type:'POST',
             url:"{{ route('addtickets') }}",
             data: {
              //  ticket_id,
               title,
               desc,
               importance
             },
            success: function() {
                window.location.href = "/client";
            }
          });
      });
    });
    </script>
@endpush