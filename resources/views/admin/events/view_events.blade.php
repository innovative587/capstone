@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Destinations</a> <a href="#" class="current">View Destinations</a> </div>
    <h1>Destinations</h1>
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
        <a href="{{ url('/admin/add-event') }}" class="btn btn-primary">Create Destination</a>
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Destinations</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Destination ID</th>
                  <th>Destination Name</th>
                  <th>Category</th>
                  <th>Description</th>
                  <th>Destination Capacity</th>
                  <th>Status</th>
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
                  @if($event->status == 1)
                    <td>Approved</td>
                  @else
                    <td>Waiting</td>
                  @endif
                  <td>
                    @if(!empty($event->image))
                    <img src="{{ asset('/images/backend_images/events/small/'.$event->image) }}" style="width: 60px;">
                    @endif
                  </td>
                  <td>
                    <div class="center">
                      <a href="#myModal{{ $event->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> 
                      @if($event->status == 0)
                      <a href="{{ url('/admin/approve-event/'.$event->id) }}" class="btn btn-primary btn-mini">Approve</a> 
                      @endif
                      <a href="{{ url('/admin/edit-event/'.$event->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                      <a id="delEvent" href="{{ url('/admin/delete-event/'.$event->id) }}" class="btn btn-danger btn-mini">Delete</a>
                    </div>
                  </td>
                </tr>
                <div id="myModal{{ $event->id }}" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>{{ $event->event_name }} Full Details</h3>
                  </div>
                  <div class="modal-body">
                    <p>Destination ID: {{ $event->id }}</p>
                    <p>Destination Name: {{ $event->event_name }}</p>
                    <p>Destination Address: {{ $event->event_address }}</p>
                    <p>Destination Schedule: {{ $event->event_schedule }}</p>
                    <p>Destination Description: {{ $event->description }}</p>
                    <p>Status: {{ $event->status }}</p>
                    <p>Destination Capacity: {{ $event->event_capacity }}</p>
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