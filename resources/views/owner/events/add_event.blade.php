@extends('layouts.ownerLayout.admin_design')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Events</a> <a href="#" class="current">Add Events</a> </div>
  <h1>Add Events</h1>
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
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Events</h5>
        </div>
        <div class="widget-content nopadding">
          <form enctype="multipart/form-data" method="post" action="{{ url('/owner/add-event') }}" class="form-horizontal" name="add_event" id="add_event_owner" novalidate="novalidate">{{ csrf_field() }}
            <div class="control-group">
              <label class="control-label">Under Category</label>
              <div class="controls">
                <select name="category_id">
                  <?php echo $categoriesdd; ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Event Name</label>
              <div class="controls">
                <input type="text" name="event_name" id="event_name" class="span11">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Event Address</label>
              <div class="controls">
                <textarea name="event_address" id="event_address" class="span11"></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Event Schedule</label>
              <div class="controls">
                <input type="text" name="event_sched" id="event_sched" class="span11">to
                <!-- <input type="text" class="timepicker" name="timepicker" placeholder="Start time"> -->
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Description</label>
              <div class="controls">
                <textarea name="description" id="description" class="span11"></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Reservation Fee</label>
              <div class="controls">
                <input type="text" name="event_fee" id="event_fee" class="span11">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Event Capacity</label>
              <div class="controls">
                <input type="text" name="event_capacity" id="event_capacity" class="span11">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Latitude</label>
              <div class="controls">
                <input type="text" name="latitude" id="latitude" class="span11">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Longitude</label>
              <div class="controls">
                <input type="text" name="longitude" id="longitude" class="span11">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Image</label>
              <div class="controls">
                <input type="file" name="image" id="image" class="span11">
              </div>
            </div>
            <div class="form-actions">
              <input type="submit" value="Add Event" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>
@endsection