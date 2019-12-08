@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Popular Places -->
<section id="popular" class="section section-popular scrollspy">
	<div class="container">
		<div class="row">
			<div class="col s12 m12">    
				<h5>Fill up form</h5> 
				<blockquote>
					Fields marked with an * are required If you would like to reserve a visit to EDIT THIS, please fill in your details in this Reservation Form below.
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
				<div class="input-field col s12">
					<!-- <input type="text" id="nop" name="nop" required> -->
					<label for="nop">Number of people *</label><br>
					<p class="range-field">
						<input type="range" name="nop" id="nop" min="1" max="3" />
					</p>
				</div>
				<!-- <input type="submit" value="Submit" class="btn"> -->
				<!-- payment here -->  
			</div>
		</div>
	</div>
</div>
</section>
@endsection
