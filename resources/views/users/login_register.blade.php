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
      <div class="col s12 m3">
      </div>
      <div class="col s12 m6">
        <div class="card-panel grey lighten-3 hoverable">
          <form id="loginForm" name="loginForm" action="{{ url('/user-login') }}" method="post">{{ csrf_field() }}
            <h5>Login</h5>
            <div class="input-field">
              <input type="email"  id="email" name="email">
              <label for="email">Email</label>
            </div>
            <div class="input-field">
              <input type="password" id="myPassword" name="password">
              <label for="password">Password</label>
            </div>
            <div class="input-field">
              <input id="validate" type="submit" value="Login" class="btn">
            </div>
            <div class="input-field">
              <h6>Don't have an account yet?</h6>
              <a href="{{ url('/user-register') }}" class="btn">Create an Account</a>
            </div>
          </form>
        </div>
      </div>
    <div class="col s12 m3"></div>
  </div>
</div>
</section>
@endsection