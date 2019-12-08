<!DOCTYPE html>
<html lang="en">
<head>
  <title>EduTrip</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,700,900|Display+Playfair:200,300,400,700"> 
  <link rel="stylesheet" href="{{ asset('fonts/frontend_fonts/icomoon/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/magnific-popup.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('css/frontend_css/jquery-ui.css') }}"> -->
  <link rel="stylesheet" href="{{ asset('css/frontend_css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/bootstrap-datepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('fonts/frontend_fonts/flaticon/font/flaticon.css') }}">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css"> -->
  <link rel="stylesheet" href="{{ asset('css/frontend_css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/passtrength.css') }}">
  
  <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
  @mapstyles
</head>
<body>

  <div class="site-wrap">
    @include('layouts.frontLayout.front_header')
    @yield('content')
    @include('layouts.frontLayout.front_footer')
  </div>

  <script src="{{ asset('js/frontend_js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/jquery-ui.js') }}"></script>
  <script src="{{ asset('js/frontend_js/jquery.validate.js') }}"></script>
  <script src="{{ asset('js/frontend_js/popper.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('js/frontend_js/passtrength.js') }}"></script>
  <script src="{{ asset('js/frontend_js/aos.js') }}"></script>
  <script src="{{ asset('js/frontend_js/main.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
  {!! $calendar->script() !!}
  @mapscripts
</body>
</html>