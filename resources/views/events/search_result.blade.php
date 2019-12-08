@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Search -->
<section id="search" class="section section-search teal darken-1 white-text center scrollspy">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<h3>Search Destinations</h3>
				<form action="{{ url('search') }}" method="GET"> {{ csrf_field() }}
					<div class="input-field">
						<input type="text" name="query" id="query" minlength="3" value="{{ request()->input('query') }}" class="white grey-text">
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
	<div class="container">
		<div class="row">
			<h5>Search Results</h5>
			<p>{{ $search_results->count() }} result(s) for '{{ request()->input('query') }}'</p>
			<ul class="collection">
				@foreach($search_results as $rs)
				<li class="collection-item avatar">
					<img src="{{ asset('images/backend_images/events/large/'.$rs->image) }}" alt="" class="circle materialboxed responsive">
					<span class="title">{{ $rs->event_name }}</span>
					<p class="truncate">
						{{ $rs->description }}
					</p>
					<a href="{{ url('event/'.$rs->id) }}" class="secondary-content"><i class="material-icons">arrow_forward</i></a>
				</li>
				@endforeach
			</ul>
			{{ $search_results->appends(request()->input())->links() }}
		</div>
	</div>
</section>
@endsection