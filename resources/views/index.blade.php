@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Slider -->
<section class="slider">
  <ul class="slides">
    <li>
      <img src="{{ asset('images/frontend_images/resort4.jpg') }}">
      <!-- random image -->
      <div class="caption center-align">
        <h2>Take Your Dream Vacation</h2>
        <h5 class="light grey-text text-lighten-3 hide-on-small-only">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, provident eos dicta unde debitis</h5>
      </div>
    </li>
    <li>
      <img src="{{ asset('images/frontend_images/resort5.jpg') }}">
      <!-- random image -->
      <div class="caption left-align">
        <h2>We Work With All Budgets</h2>
        <h5 class="light grey-text text-lighten-3 hide-on-small-only">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus delectus inventore neque impedit</h5>
      </div>
    </li>
    <li>
      <img src="{{ asset('images/frontend_images/resort6.jpg') }}">
      <!-- random image -->
      <div class="caption right-align">
        <h2>Group & Individual Getaways</h2>
        <h5 class="light grey-text text-lighten-3 hide-on-small-only">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt ipsum molestias excepturi doloremque</h5>
      </div>
    </li>
  </ul>
</section>
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

<!-- Section: Icon Boxes -->
<section class="section section-icons grey lighten-4 center">
  <div class="container">
    <div class="row">
      <div class="col s12 m4">
        <div class="card-panel">
          <i class="material-icons large teal-text">room</i>
          <h4>Pick Where</h4>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, tempore?</p>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card-panel">
          <i class="material-icons large teal-text">store</i>
          <h4>Travel Shop</h4>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, tempore?</p>
        </div>
      </div>
      <div class="col s12 m4">
        <div class="card-panel">
          <i class="material-icons large teal-text">airplanemode_active</i>
          <h4>Fly Cheap</h4>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, tempore?</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
  <div class="container">
    <div class="row">
      <h4 class="center">
        <span class="teal-text">Popular</span> Places</h4>
        @foreach($eventsAll as $event)
        <div class="col s12 m12">
          <div class="card hoverable">
            <div class="card-image">
              <img src="{{ asset('images/backend_images/events/large/'.$event->image) }}" alt="" class="materialboxed responsive-img">
              <a href="{{ url('event/'.$event->id) }}"><span class="card-title"><b>{{ $event->event_name }}</b></span></a>
            </div>
            <div class="card-content">
              <p>
                {{ substr($event->description,0,120) }}
                <a href="{{ url('event/'.$event->id) }}">See more</a>
              </p>
              <p>{{ $event->created_at->diffForHumans() }}<br><a href="{{ url('user-details/'.$event->user_id) }}">Send message</a></p>
            </div>
            <!-- <a href="{{ url('schedule-a-trip/'.$event->id) }}"> -->
            <a href="{{ url('schedule-a-trip/'.$event->id) }}"><input type="submit" value="Schedule a trip" class="btn"></a>
            <?php
              date_default_timezone_set('Asia/Kuala_Lumpur');
              echo " " . date("H:i:s A");
            ?>
           <p><img src="{{ asset('images/backend_images/icons/7pmicon.jpg') }}">Open Now</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Section: Gallery -->
  <section id="gallery" class="section section-gallery scrollspy">
    <div class="container">
      <h4 class="center">
        <span class="teal-text">Photo</span> Gallery
      </h4>
      <div class="row">
        @foreach($eventsAll as $pics)
        <div class="col s12 m3">
          <img src="{{ asset('images/backend_images/events/large/'.$pics->image) }}" alt="" class="materialboxed responsive-img">
        </div>
        @endforeach
        </div>
      </div>
    </div>
  </section>

  <!-- Section: Contact -->
  <section id="contact" class="section section-contact scrollspy">
    <div class="container">
      <div class="row">
        <div class="col s12 m6">
          <div class="card-panel teal white-text center">
            <i class="material-icons">email</i>
            <h5>Contact Us For Booking</h5>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium fugit tempore hic enim possimus molestias
            quisquam impedit corrupti eveniet.</p>
          </div>
          <ul class="collection with-header">
            <li class="collection-header">
              <h4>Location</h4>
            </li>
            <li class="collection-item">Travelville Agency</li>
            <li class="collection-item">555 Beach Rd, Suite 33</li>
            <li class="collection-item">Miami, FL 55555</li>
          </ul>
        </div>
        <div class="col s12 m6">
          <div class="card-panel grey lighten-3">
            <h5>Please fill out this form</h5>
            <div class="input-field">
              <input type="text" placeholder="Name">
            </div>
            <div class="input-field">
              <input type="text" placeholder="Email">
            </div>
            <div class="input-field">
              <input type="text" placeholder="Phone">
            </div>
            <div class="input-field">
              <textarea class="materialize-textarea" placeholder="Enter Message"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn">
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection