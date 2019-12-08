@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
<div class="container grey lighten-3 z-depth-2">
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
    <div class="col s12 m7">    
        <table>
        <thead>
          <tr>
              <th><h4>Itineraries</h4></th>
              <th></th>
              <th></th>
          </tr>
        </thead>

        <tbody>
          @foreach($itinerary->unique('start_date') as $dat)
            @if($dat->current_id == Auth::user()->id && $dat->start_date >= date('Y-m-d'))
          <tr>
            <td>
              <a href="{{ url('/itinerary/'.$dat->session_id) }}" @if($dat->seen == 0) class="collection-item active grey lighten-2 black-text" style="font-weight: bold;" @else class="collection-item black-text" @endif>
              @if($dat->seen == 0) <span class="new badge"></span> @endif Itinerary for {{ date('F j, Y', strtotime($dat->start_date)) }}
            </a>
            </td>
            @if($dat->status == 1 || $dat->status == 0)
            <td class="right"><a href="{{ url('/cancel-reservation/'.$dat->session_id) }}" class="btn btn-success red">Cancel</a></td>
            @elseif($dat->status == 2)
            <td>Cancelled</td>
            @endif
            <td></td>
          </tr>
          @endif
        @endforeach
        </tbody>
      </table>
        </div>
        <div class="col s12 m5">
          <ul class="collection with-header">
            <li class="collection-header"><h4>Group Itinerary</h4></li>
            @foreach($tag as $ta)
            @if($ta->start_date >= date('Y-m-d'))
            <li class="collection-item">
              <a href="{{ url('/group-itinerary/'.$ta->session_id) }}" @if($ta->seen == 0) class="collection-item active grey lighten-2 black-text" @else class="collection-item" @endif>
              @if($ta->seen == 0) <span class="new badge"></span> @endif {{ date('F j, Y', strtotime($ta->start_date)) }}
              </a>
            </li>
            @endif
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection