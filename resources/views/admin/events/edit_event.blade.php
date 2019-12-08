@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Destinations</a> <a href="#" class="current">Edit Destination</a> </div>
  <h1>Edit Destination</h1>
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
          <h5>Edit Destination</h5>
        </div>
        <div class="widget-content nopadding">
          <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-event/'.$EventDetails->id) }}" class="form-horizontal" name="event_event" id="edit_event" novalidate="novalidate">{{ csrf_field() }}
          <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <select name="status">
                  <option selected disabled value="0">Select</option>
                  <option value="1">Approve</option>
                  <option value="2">Decline</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Under Category</label>
              <div class="controls">
                <select name="category_id">
                  <?php echo $categoriesdd; ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Destination Name</label>
              <div class="controls">
                <input type="text" name="event_name" id="event_name" class="span11" value="{{ $EventDetails->event_name }}">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Destination Address</label>
              <div class="controls">
                <textarea name="event_address" id="event_address" class="span11">{{ $EventDetails->event_address }}</textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Destination Schedule</label>
              <div class="controls">
                <input type="text" name="event_sched" id="event_sched" class="span11" value="{{ $EventDetails->event_schedule }}">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Description</label>
              <div class="controls">
                <textarea name="description" id="description" class="span11">{{ $EventDetails->description }}</textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Destination Fee</label>
              <div class="controls">
                <input type="text" name="event_fee" id="event_fee" class="span11" value="{{ $EventDetails->price }}">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Destination Capacity</label>
              <div class="controls">
                <input type="text" name="event_capacity" id="event_capacity" class="span11" value="{{ $EventDetails->event_capacity }}">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Image</label>
              <div class="controls">
                <input type="file" name="image" id="image" class="span11">
                <input type="hidden" name="current_image" value="{{ $EventDetails->image }}">
                @if(!empty($EventDetails->image))
                <img style="width: 40px;" src="{{ asset('/images/backend_images/events/small/'.$EventDetails->image) }}">
                 | <a href="{{ url('/admin/delete-event-image/'.$EventDetails->id) }}"><strong>DELETE</strong></a>
                @endif
              </div>
            </div>
            <div class="form-actions">
              <input type="submit" value="Update Event" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>
@endsection