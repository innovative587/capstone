@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m12">
        <ul class="collection with-header">
          <a href="" class="waves-effect waves-light btn right tooltipped" data-position="bottom" data-tooltip="Download PDF">
            <i class="medium material-icons">file_download</i>
          </a>
          <li class="collection-header"><h4>Itinerary for {{ date('F j, Y', strtotime($date)) }}</h4></li>
          @foreach($details as $iti)
          <li class="collection-item">{{ $iti->start_time }} - {{ $iti->end_time }} ---- {{ $iti->event_name }}</li>
          @endforeach
        </ul> 
      </div>
    </div>
  </div>
</div>
</section>
@endsection