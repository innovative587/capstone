@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Events</a> <a href="#" class="current">View Reservations</a> </div>
    <h1>Reservations</h1>
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
            <h5>View Reservations</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Start date</th>
                  <th>End date</th>
                  <th>Number of People</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($reservations as $res)
                <tr class="gradeX">
                  <td>{{ $res->title }}</td>
                  <td>{{ $res->start_date }}</td>
                  <td>{{ $res->end_date }}</td>
                  <td>{{ $res->nop }}</td>
                  @if($res->status == 1)
                  <td>Approved</td>
                  @elseif($res->status == 2)
                  <td>Cancelled</td>
                  @elseif($res->status == 0)
                  <td>Waiting</td>
                  @endif
                  <td>
                    <div class="center">
                      <a href="#myModal{{ $res->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> 
                      @if($res->status == 0)
                      <a href="{{ url('/admin/approve-reservation/'.$res->id) }}" class="btn btn-primary btn-mini">Approve</a> 
                      @endif
                      <a id="delReservation" href="{{ url('/admin/delete-reservation/'.$res->id) }}" class="btn btn-danger btn-mini">Delete</a>
                    </div>
                  </td>
                </tr>
                <div id="myModal{{ $res->id }}" class="modal hide">
                  <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">×</button>
                    <h3>Full Details</h3>
                  </div>
                  <div class="modal-body">
                    <p>Reservation ID: {{ $res->id }}</p>
                    <p>User ID: {{ $res->current_id }}</p>
                    <p>Owner ID: {{ $res->owner_id }}</p>
                    <p>Event ID: {{ $res->event_id }}</p>
                    <p>Date of Visit: {{ $res->start_date }}</p>
                    <p>Number of People: {{ $res->nop }}</p>
                    <p>Status: {{ $res->status }}</p>
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