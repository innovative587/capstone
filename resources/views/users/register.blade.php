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
      <div class="col s12 m2"></div>
      <div class="col s12 m8">
        @if($errors->any())
      <div>
        <ul>
          <div id="card-alert" class="card red lighten-5">
            <div class="card-content red-text">
              <p>
                <a href="#" type="button" class="close red-text right" data-dismiss="alert" aria-label="Close" onclick="document.getElementById('card-alert').style.display='none'">
                <span aria-hidden="true" class="right">X</span>
              </a>
                @foreach($errors->all() as $error)
                {{ $error }}<br>
                @endforeach
              </p>
            </div>
          </div>
        </ul>
      </div>
      @endif
        <div class="card-panel grey lighten-3 hoverable">
         <form id="registerForm" name="registerForm" action="{{ url('/user-register') }}" method="post">{{ csrf_field() }}
          <h5>Signup</h5>
          <div class="input-field">
            <input type="text" id="name" name="name">
            <label for="name">Username</label>
          </div>
          <div class="input-field">
            <input type="email" id="email" name="email">
            <label for="email">Email</label>
          </div>
          <div class="input-field">
            <input type="password" id="myPassword" name="password">
            <label for="password">Password</label>
          </div>
          <input type="submit" value="Signup" class="btn">
        </form>
      </div>
      <div class="col s12 m2"></div>
    </div>
  </div>
</div>
</section>
@endsection