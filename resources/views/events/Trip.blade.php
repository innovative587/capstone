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
            <!-- <input type="text" class="white grey-text autocomplete" id="autocomplete-input" placeholder="Aruba, Cancun, etc..."> -->
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
	<div class="container" style="width: 85%;">
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
							<th>Event Name</th>
							<th>Fee per person</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<div style="display: none">
							{{ $total = 0 }}
						</div>
						@foreach($userCart as $cart)
						<tr>
							<td>{{ $cart->event_name }}</td>
							<td>{{ $cart->price }}</td>
							<td><a href="{{ url('/trip/delete-trip/'.$cart->id) }}"><i class="small material-icons">clear</i></a></td>
							<div style="display: none">{{ $total += $cart->price }}</div>
						</tr>
						@endforeach
					</tbody>
				</table>
				<h6 class="right" style="margin-right: 350px;">Total: {{ $total }}</h6>
			 	<br>
				<form enctype="multipart/form-data" id="payment-form" action="{{ url('/tripping') }}" method="post">{{ csrf_field() }}
					<h5>Fill up form</h5> 
					<blockquote>
						Fields marked with an * are required If you would like to reserve a visit to 	
						@foreach($userCart as $cart)				
						{{ $cart->event_name }},
						@endforeach
						please fill in your details in this Reservation Form below.
					</blockquote>
					<div class="input-field col s12">
						<input type="text" id="title" name="title" required>
						<label for="title">Title *</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="date" name="date" class="datepicker" required>
						<label for="date">Start date *</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="date" name="end_date" class="datepicker" required>
						<label for="date">End date</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="start_time" name="start_time" class="timepicker" required>
						<label for="start_time">Start Time *</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="end_time" name="end_time" class="timepicker" required>
						<label for="end_time">End Time *</label>
					</div>
					<div class="input-field col s6">
						<!-- <input type="text" id="nop" name="nop" required> -->
						<input type="hidden" name="nop2" id="a" value="{{ $total }}">
						<input type="number" name="nop" id="b" min="1" max="100" onkeyup="add()" class="validate"/>
						<label for="b">Number of people *</label>
						@foreach($userCart->unique('session_id') as $cart)
						<input type="hidden" name="session_id" value="{{ $cart->session_id }}">
						@endforeach
					</div>
					<div class="input-field col s2">
						<h6>Total: ₱</h6>
					</div>
					<div class="input-field col s4">
						<input type="text" name="total" id="c">
					</div>
					</div>
					<div class="col s12 m5"> 
					<h5>Billing Details</h5> 
					<div class="input-field col s12">
						<input type="text" id="email" name="email" value="{{ Auth::user()->email }}">
						<label for="email">Email</label>
					</div>
					<div class="input-field col s12">
						<input type="text" id="name_on_card" name="name_on_card" value="{{ Auth::user()->name }}">
						<label for="name_on_card">Name on Card *</label>
					</div>
					<div class="input-field col s12">
						<input type="text" id="address" name="address" value="{{ Auth::user()->address }}">
						<label for="address">Adress</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="city" name="city" value="{{ Auth::user()->city }}" required>
						<label for="city">City</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="province" name="province" value="{{ Auth::user()->province }}" required>
						<label for="province">Province</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="postalcode" name="postalcode" value="{{ Auth::user()->postal_code }}" required>
						<label for="postalcode">Postal Code</label>
					</div>
					<div class="input-field col s6">
						<input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" required>
						<label for="phone">Phone</label>
					</div>
					<h5>Payment Details</h5>
					<label for="card-element">
						Credit or debit card
					</label>
					<div id="card-element">
						<!-- A Stripe Element will be inserted here. -->
					</div>

					<!-- Used to display form errors. -->
					<div id="card-errors" role="alert"></div><br>
					<div class="card">
						<div class="card-content">
							By Clicking Submit Payment, you agree to our Terms that you have read our
							<u><a href="#"><span class="activator grey-text text-darken-4">Data Use Policy</span></a></u>,
							Including our 
							<u><a href="#"><span class="activator grey-text text-darken-4">Cookie Use</span></a></u>.
						</div>
						<div class="card-reveal">
							<span class="card-title grey-text text-darken-4">Title<i class="material-icons right">close</i></span>
							<ul>
								<li>* Reservations cannot be made on the same day of the visit.</li>
								<li>* Fill-up the required fields especially your contact details so we can get back to you immediately.</li>
							</ul>
						</div>
					</div>
					<input type="submit" value="Submit" class="btn">
					<!-- payment here -->
				</form>  
			</div>
		</div>
	</div>
</div>
</section>
@endsection