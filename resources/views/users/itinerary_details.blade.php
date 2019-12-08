@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
  <div class="container" style="width: 80%;">
    @if(Session::has('flash_message_error'))
    <div id="card-alert" class="card red lighten-5">
      <div class="card-content red-text">
        <p>{!! session('flash_message_error') !!}<a href="" type="button" class="close red-text right" data-dismiss="alert" aria-label="Close" onclick="document.getElementById('card-alert').style.display='none'">
          <span aria-hidden="true">X</span>
        </a></p>
      </div>
    </div>
    @endif  
    @if(Session::has('flash_message_success'))
    <div id="card-alert" class="card green lighten-5">
      <div class="card-content green-text">
        <p>{!! session('flash_message_success') !!}<button type="button" class="close green-text right" data-dismiss="alert" aria-label="Close" onclick="document.getElementById('card-alert').style.display='none'">
          <span aria-hidden="true">×</span>
        </button></p>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="col s12 m7">
        <ul class="collection with-header">
          <a href="" class="waves-effect waves-light btn right tooltipped" data-position="bottom" data-tooltip="Download PDF">
            <i class="medium material-icons">file_download</i>
          </a><br>
          <li draggable="true" class="collection-header">
          <h4>Itinerary for 
          @foreach($date as $da)
          {{ date('F j, Y', strtotime($da->start_date)) }}
          @endforeach
          </h4>
          </li>
          @foreach($details as $iti)
          <li class="collection-item">{{ $iti->event_name }}<a href="{{ url('event/'.$iti->event_id) }}" class="waves-effect waves-light btn-small right">View map</a></li>
          @endforeach
        </ul> 
      </div>
      <div class="col s12 m5">
        <form enctype="multipart/form-data" method="post" action="{{ url('/add-people') }}" name="add_people" id="add_people">{{ csrf_field() }}
          <div class="modal-content">
            <h5>Add People</h5>
            <div class="input-field col s4">
              @foreach($date as $da)
              <input value="{{ $da->start_date }}" id="start_date" name="start_date" type="text" class="validate">
              <label for="start_date">Date</label>
              @endforeach
            </div>
            <div class="input-field col s8">
              <select multiple name="useryawa[]">
                <option value="" disabled selected>Select</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" value="Add People" class="btn btn-success">
          </div>
        </form>
        <ul class="collection with-header">
          <li class="collection-header"><h5>Members</h5></li>
          @foreach($members as $member)
          @if($member->start_date == $date)
          <li class="collection-item"><i class="small material-icons left">account_circle</i>{{ $member->name }} ({{ $member->email }})</li>
          @endif
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
</section>
@endsection