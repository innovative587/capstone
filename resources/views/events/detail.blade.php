@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: fill up -->
<section id="contact" class="section section-contact scrollspy">
  <div class="container" style="width: 90%;">
    <div class="row" style="border-radius: 10px;">
      <div class="col s12 m8">
          @map([
            'lat' => $eventDetails->latitude,
            'lng' => $eventDetails->longitude,
            'zoom' => '15',
            'markers' => [[
              'title' => 'Marker',
              'lat' => $eventDetails->latitude,
              'lng' => $eventDetails->longitude,
            ]],
          ])
      </div>
      <div class="col s12 m4 right">
        <div class="card">
          <div class="card-image">
            <img src="{{ asset('images/backend_images/events/large/'.$eventDetails->image) }}">
            <span class="card-title">{{ $eventDetails->event_name }}</span>
          </div>
          <div class="card-content">
            <p>{{ $eventDetails->description }}</p><br>
            <p><b>Address: </b>{{ $eventDetails->event_address }}</p>
            <p><b>Schedule: </b>{{ $eventDetails->event_schedule }}</p>
            <p><b>Reservation Fee: </b>₱ {{ $eventDetails->price }}</p>
          </div>
          <a href="{{ url('schedule-a-trip/'.$eventDetails->id) }}"><input type="submit" value="Schedule a trip" class="btn"></a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
