@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
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
      <form enctype="multipart/form-data" method="post" action="{{ url('/add-people') }}" name="add_people" id="add_people">{{ csrf_field() }}
        <div class="modal-content">
          <h4>Add People</h4>
          <div class="input-field col s4">
            <input value="{{ $date }}" id="start_date" name="start_date" type="text" class="validate">
            <label for="start_date">Date</label>
          </div>
          <div class="input-field col s8">
            <select multiple name="useryawa[]">
              <option value="" disabled selected>Select</option>
              @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" value="Add People" class="btn btn-success">
        </div>
      </form>
    </div>
  </div>
</div>
</section>
@endsection