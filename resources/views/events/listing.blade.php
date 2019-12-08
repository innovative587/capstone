@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Search -->
<section id="search" class="section section-search teal darken-1 white-text center scrollspy">
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h3>Search Destinations</h3>
        <form action="{{ url('search') }}" method="GET"> {{ csrf_field() }}
          <div class="input-field">
            <input type="text" name="query" id="query" minlength="3" value="{{ request()->input('query') }}" class="white grey-text">
            <!-- <input type="text" class="white grey-text autocomplete" id="autocomplete-input" placeholder="Aruba, Cancun, etc..."> -->
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- Section: Popular Places -->
<section id="contact" class="section section-contact scrollspy">
  <div class="row grey lighten-3" style="border-radius: 10px;">
    <div class="col s12 m12">
      <h4 class="center"><span class="teal-text">Popular</span> Places</h4>
      @foreach($eventsAll as $event)
      <form name="addtocartForm" id="addtocartForm" action="{{ url('add-trip') }}" method="post">{{ csrf_field() }}
      <div class="col s12 m3">
        <div class="card small">
          <div class="card-image">
            <img src="{{ asset('images/backend_images/events/large/'.$event->image) }}" alt="">
            <a href="{{ url('event/'.$event->id) }}"><span class="card-title"><b>{{ $event->event_name }}</b></span></a>
          </div>
          <div class="card-content">
            <p class="truncate">
            {{ $event->description }}
            </p>
          </div>
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <input type="hidden" name="event_name" value="{{ $event->event_name }}">
            <input type="hidden" name="event_fee" value="{{ $event->price }}">
            <input type="hidden" name="event_capacity" value="{{ $event->event_capacity }}">
            <!-- <a href="{{ url('schedule-a-trip/'.$event->id) }}"> -->
            <input type="submit" value="Add to trip" class="btn">
        </div>
      </div>
      </form>
      @endforeach
    </div>
  </div>
</section>
@endsection