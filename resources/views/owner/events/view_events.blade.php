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
        <a href="{{ url('/owner/add-event') }}" class="btn btn-primary">Create Event</a>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Events</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Event ID</th>
                  <th>Event Name</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Event Capacity</th>
                  <th>Image</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($events as $event)
                <tr class="gradeX">
                  <td>{{ $event->id }}</td>
                  <td>{{ $event->event_name }}</td>
                  <td>{{ $event->category_name }}</td>
                  <td>{{ substr($event->description,0,40) }}...</td>
                  <td>{{ $event->event_capacity }}</td>
                  <td>
                    @if(!empty($event->image))
                      <img src="{{ asset('/images/backend_images/events/small/'.$event->image) }}" style="width: 60px;">
                    @endif
                  </td>
                  <td>
                    <div class="center">
                      <a href="#myModal{{ $event->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> 
                      <a href="{{ url('/owner/edit-event/'.$event->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a id="delEvent" href="{{ url('/owner/delete-event/'.$event->id) }}" class="btn btn-danger btn-mini">Delete</a>
                    </div>
                  </td>
                </tr>
                <div id="myModal{{ $event->id }}" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>{{ $event->event_name }} Full Details</h3>
                  </div>
                  <div class="modal-body">
                    <p>Event ID: {{ $event->id }}</p>
                    <p>Event Name: {{ $event->event_name }}</p>
                    <p>Event Address: {{ $event->event_address }}</p>
                    <p>Event Schedule: {{ $event->event_schedule }}</p>
                    <p>Event Description: {{ $event->description }}</p>
                    <p>Event Fee: {{ $event->price }}</p>
                    <p>Event Capacity: {{ $event->event_capacity }}</p>
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