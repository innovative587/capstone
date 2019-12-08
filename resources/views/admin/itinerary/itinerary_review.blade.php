@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Itinerary</a> <a href="#" class="current">View Itinerary</a> </div>
    <h1>View Itinerary</h1>
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
        <div class="widget-title"> <span class="icon"> <i class="icon-refresh"></i> </span>
          <h5>Itinerary</h5>
        </div>
        @foreach($itinerary as $iti)
        <div class="widget-content nopadding updates">
          <div class="new-update clearfix">
            <div class="update-date" style="float: left;"><span class="update-day">{{ $iti->time }}</span></div>
            <div class="update-done" style="padding-left: 40px;">
              <span>{{ $iti->description }}</span> 
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endsection