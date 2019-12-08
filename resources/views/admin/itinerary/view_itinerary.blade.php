@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Itinerary</a> <a href="#" class="current">Create Itinerary</a> </div>
    <h1>Create Itinerary</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
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
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Reservations</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>Reservation ID</th>
                <th>Reserved by</th>
                <th>description</th>
              </tr>
            </thead>
            <tbody>
              @foreach($itinerary as $iti)
              <tr class="gradeX">
                <td>{{ $iti->reservation_id }}</td>
                <td>{{ $iti->description }}</td>
                <td>
                  <a href="{{ url('/admin/itinerary-review/'.$iti->reservation_id) }}" class="btn btn-success">View</a>
                  <a href="{{ url('/admin/itinerary-review/'.$iti->reservation_id) }}" class="btn btn-primary">Generate PDF</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endsection