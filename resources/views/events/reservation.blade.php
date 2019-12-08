@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: fill up -->
  <section id="contact" class="section section-contact scrollspy">
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
    <div class="row" style="border-radius: 10px;">
      <div class="col s12 m2">
      <ul class="collection with-header">
        <li class="collection-header"><h5>Recent</h5></li>
        @foreach($recent as $re)
        <li class="collection-item"><a href="{{ url('event/'.$re->id) }}">{{ $re->event_name }}</a></li>
        @endforeach
      </ul>
      </div>
      <form name="addtocartForm" id="addtocartForm" action="{{ url('add-trip') }}" method="post">{{ csrf_field() }}
      <div class="col s12 m10">
        <div class="card horizontal medium">
          <div class="card-image">
            <img src="{{ asset('images/backend_images/events/large/'.$eventSched->image) }}">
          </div>
          <div class="card-stacked">
            <div class="card-content">
            <span class="card-title">{{ $eventSched->event_name }}</span>
              <p>{{ $eventSched->description }}</p><br>
              <p><b>Address: </b>{{ $eventSched->event_address }}</p>
              <p><b>Schedule: </b>{{ $eventSched->event_schedule }}</p>
              <p><b>Reservation Fee: </b>₱ {{ $eventSched->price }}</p>
            </div>
            <div class="card-action">
              <input type="hidden" name="event_id" value="{{ $eventSched->id }}">
              <input type="hidden" name="event_name" value="{{ $eventSched->event_name }}">
              <input type="hidden" name="event_fee" value="{{ $eventSched->price }}">
              <input type="hidden" name="event_capacity" value="{{ $eventSched->event_capacity }}">
              <input type="hidden" name="latitude" value="{{ $eventSched->latitude }}">
              <input type="hidden" name="longitude" value="{{ $eventSched->longitude }}">
              <input type="submit" value="Add to trip" class="btn">
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </section>

  <section id="contact" class="section section-contact scrollspy">
    <div class="row grey lighten-3 hoverable" style="border-radius: 10px;">
      <div class="col s12 m12 hoverable">
      <h4 class="center">
        <span>Places nearby</h4>
          @foreach($nearby as $near)
          <div class="col s12 m3">
            <div class="card small">
              <div class="card-image waves-effect waves-block waves-light">
                <img src="{{ asset('images/backend_images/events/small/'.$near->image) }}" alt="">
              </div>
              <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">{{ $near->event_name }}<i class="material-icons right">more_vert</i></span>
                <a href="{{ url('schedule-a-trip/'.$near->id) }}"><input type="submit" value="Schedule a trip" class="btn"></a>
              </div>
              <div class="card-reveal">
                <span class="card-title grey-text text-darken-4">{{ $near->event_name }}<i class="material-icons right">close</i></span>
                <p>{{ $near->description }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endsection
