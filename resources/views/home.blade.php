@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <div><a href="{{ route('add_event') }}"><button class="btn btn-primary">Add Event</button></a></div>
            <div>

                <script>
                  @if(Session::has('success_added'))
                      toastr.options =
                      {
                          "closeButton" : true,
                          "progressBar" : true
                      }
                      toastr.success("{{ session('success_added') }}");
                  @endif

                  @if(Session::has('failed_added'))
                      toastr.options =
                      {
                          "closeButton" : true,
                          "progressBar" : true
                      }
                      toastr.error("{{ session('failed_added') }}");
                  @endif
              </script>

       <table class="table table-striped">
        <thead>
            <tr class="table-active">
                <th>Sr no.</th>
                <th>Name</td>
                <th>Description</th>
                <th>Type</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @if(count($events) > 0)
              @foreach($events as $event)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->description }}</td>
                    <td>{{ $event->types->name }}</td>
                    <td><img src="{{ url('event_images/').'/'.$event->image }}" width="100" height="100"></td>
                    <td>
                        <form action="{{ route('delete_event', $event->id) }}" method="POST" class="event-del">
            
                            <a class="btn btn-primary" href="{{ route('edit_event', $event->id) }}">Edit</a>
           
                            @csrf
                            @method('DELETE')
              
                            <button type="submit" class="btn btn-danger ">Delete</button>
                        </form>
                    </td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="12">No Event found.</td></tr>
            @endif
        </tbody>
    </table>
            </div>
        </div>
    </div>
</div>
@endsection
