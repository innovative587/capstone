@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Head -->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
  <br>
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
      <div class="col-md-6">
        @foreach($users as $user)
        <div class="profile-head">
          <h5>
            {{ $user->first_name }} {{ $user->last_name }}
          </h5>
          <h6>
            {{ $user->email }}
          </h6>
          <br>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit Profile</a>
            </li>
          </ul>
        </div>
        @endforeach
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">

      </div>
      <div class="col-md-8">
        <form enctype="multipart/form-data" action="{{ url('/account/edit-profile') }}" method="post" name="edit_account" id="edit_account">{{ csrf_field() }}
        <div class="tab-content profile-tab" id="myTabContent">
          @foreach($users as $user)
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-md-5">
                <p>
                  <label for="firstname">First Name</label>
                  <input type="text" name="firstname" id="firstname" value="{{ $user->first_name }}">
                </p>
              </div>
              <div class="col-md-5">
                <p>
                  <label for="lastname">Last Name</label>
                  <input type="text" name="lastname" value="{{ $user->last_name }}">
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10">
                <p>
                  <label for="address">Address</label>
                  <input type="text" name="address" value="{{ $user->address }}">
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <p>
                  <label for="city">City</label>
                  <input type="text" name="city" id="city" value="{{ $user->city }}">
                </p>
              </div>
              <div class="col-md-5">
                <p>
                  <label for="province">Province</label>
                  <input type="text" name="province" value="{{ $user->province }}">
                </p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <p>
                  <label for="city">Postal Code</label>
                  <input type="text" name="postal_code" id="postal_code" value="{{ $user->postal_code }}">
                </p>
              </div>
              <div class="col-md-5">
                <p>
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" value="{{ $user->phone }}">
                </p>
              </div>
            </div>
            <input type="submit" name="Submit" value="Update Profile" class="btn">
          </div>
          @endforeach
        </div>
        </form>
      </div>
    </div>           
</div>
@endsection