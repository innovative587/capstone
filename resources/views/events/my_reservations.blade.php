@extends('layouts.frontLayout1.front_design')
@section('content')

<!-- Section: fill up -->
<section id="contact" class="section section-contact scrollspy">
  <div style="width: 95%;" class="container">
    <div class="row grey lighten-3 hoverable" style="border-radius: 10px;">
      <div class="col s12 m7 blue lighten-4" style="border-radius: 10px;">
        {!! $calendar->calendar() !!}
        {!! $calendar->script() !!}
      </div>
      <div class="col s12 m5 z-depth-2">
      	<table class="responsive-table highlight centered">
        <thead>
          <tr>
              <th>Title</th>
              <th>Start date</th>
              <th>End date</th>
              <th>Status</th>
              <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $dat)
          <tr>
            <td>{{ $dat->title }}</td>
            <td>{{ $dat->start_date }}</td>
            <td>{{ $dat->end_date }}</td>
            @if($dat->status == 1)
            <td>Approved</td>
            @else
            <td>Waiting</td>
            @endif
            <td>
              <a href="{{ url('event/'.$dat->event_id) }}" class="waves-effect waves-light btn-small @if($dat->status == 0) disabled @endif">View</a>
              <a class="waves-effect waves-light btn-small red darken-2 @if($dat->status == 0) disabled @endif">Cancel</a>
            </td>
          </tr>
          @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection
