@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Head -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
  <br>
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
  <form method="post">
    <div class="row">
      <div class="col-md-4">
        <div class="profile-img">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
          <div class="file btn btn-lg btn-primary">
            Change Photo
            <input type="file" name="file"/>
          </div>
        </div>
      </div>
      @foreach($users as $user)
      <div class="col-md-6">
        <div class="profile-head">
          <h5>
            {{ $user->first_name }} {{ $user->last_name }}
          </h5>
          <br>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <a href="{{ url('/account/edit-profile') }}" class="profile-edit-btn" name="profile-edit-btn">Edit Profile</a>
      </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col-md-4">
      </div>
      <div class="col-md-8">
        <div class="tab-content profile-tab" id="myTabContent">
          @foreach($users as $user)
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-md-6">
                <label>Username</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->name }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Name</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->first_name }} {{ $user->last_name }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Email</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->email }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Address</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->address }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>City</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->city }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Province</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->province }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Postal Code</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->postal_code }}</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Phone</label>
              </div>
              <div class="col-md-6">
                <p>{{ $user->phone }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </form>           
</div>
@endsection