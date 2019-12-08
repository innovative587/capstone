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
      <div class="span7">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Form Elements</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/create-itinerary') }}" name="create_itinerary" id="create_itinerary">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Select Reservation ID</label>
                <div class="controls">
                  <select name="res_id" id="res_id" class="span6 m-wrap">
                    <option value="0">Reservation ID</option>
                    @foreach($reservation as $res)
                    <option>{{ $res->id }}</option>
                    @endforeach
                  </select>
                  <br>
                </div>
                <label class="control-label">Select User</label>
                <div class="controls">
                  <select name="user_id" id="user_id" class="span6 m-wrap">
                    <option>Select User</option>
                    @foreach($reservation as $rese)
                    <option value="{{ $rese->current_id }}">{{ $rese->current_name }}</option>
                    @endforeach
                  </select>
                  <br>
                </div>
                <div class="control-group">
                  <label class="control-label">Title</label>
                  <div class="controls">
                    <input type="text" name="title" id="title" class="span11">
                  </div>
                </div>
                <div class="field_wrapper">
                  <div style="padding-left: 10px;">
                    <input type="text" name="time[]" id="time" class="span3" placeholder="Time" style="margin-right: 3px;" />
                    <textarea class="span8" name="description[]" id="description" placeholder="Description"></textarea>
                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                  </div>
                </div>
                <!-- <div class="controls field_wrapper">
                  <div>
                    <input type="text" name="time[]" id="time" placeholder="Time" style="width: 100px;" />
                    <input type="text" name="description[]" id="description" placeholder="Description" style="width: 500px;" />
                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                  </div>
                </div> -->
              </div>
              <div class="form-actions">
                <input type="submit" value="create Itinerary" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="span5">
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
                  <th>Title</th>
                  <th>Start date</th>
                  <th>End date</th>
                </tr>
              </thead>
              <tbody>
                @foreach($reservation as $res)
                <tr class="gradeX">
                  <td>{{ $res->id }}</td>
                  <td>{{ $res->current_name }}</td>
                  <td>{{ $res->title }}</td>
                  <td>{{ $res->start_date }}</td>
                  <td>{{ $res->end_date }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    @endsection