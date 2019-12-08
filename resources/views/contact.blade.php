@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Contact -->
  <section id="contact" class="section section-contact scrollspy">
    <div class="container">
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
          <form action="{{ url('/contact-us') }}" id="contact-us" name="contact-us" method="post">{{ csrf_field() }}
          <div class="card-panel grey lighten-3">
            <h5>Please fill out this form</h5>
            <div class="input-field">
              <input type="text" name="name" placeholder="Name">
            </div>
            <div class="input-field">
              <input type="text" name="email" placeholder="Email">
            </div>
            <div class="input-field">
              <input type="text" name="phone" placeholder="Phone">
            </div>
            <div class="input-field">
              <textarea class="materialize-textarea" name="message" placeholder="Enter Message"></textarea>
            </div>
            <input type="submit" value="Submit" class="btn">
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>
 @endsection