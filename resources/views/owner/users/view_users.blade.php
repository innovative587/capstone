@extends('layouts.ownerLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Events</a> <a href="#" class="current">View Events</a> </div>
    <h1>Events</h1>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif   
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <!-- <a href="{{ url('/admin/add-event') }}" class="btn btn-primary">Create Event</a> -->
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Events</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Created at</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($users as $user)
                <tr class="gradeX">
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>
                    <div class="center">
                      <a href="#myModal{{ $user->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> 
                      <a href="{{ url('/admin/edit-user/'.$user->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a onclick="return myFunction();" href="{{ url('/admin/delete-user/'.$user->id) }}" class="btn btn-danger btn-mini">Delete</a>
                      <script>
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
</script>
                    </div>
                  </td>
                </tr>
                <div id="myModal{{ $user->id }}" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>Full Details</h3>
                  </div>
                  <div class="modal-body">
                    <p>User ID: {{ $user->id }}</p>
                    <p>Username: {{ $user->name }}</p>
                    <p>Email: {{ $user->email }}</p>
                    <p>Created at: {{ $user->created_at }}</p>
                  </div>
                </div>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection