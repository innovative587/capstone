<!-- Navbar -->
<div class="navbar-fixed">
  <nav class="teal">
    <div class="container" style="width: 85%;">
      <div class="nav-wrapper">

        <a href="{{ url('/') }}" class="brand-logo">Edutrip</a>
        <a href="#" data-target="mobile-nav" class="sidenav-trigger">
          <i class="material-icons">menu</i>
        </a>
        <ul class="right hide-on-med-and-down">

          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/about-us') }}">About</a></li>
          <li><a href="{{ url('/contact-us') }}">Contact</a></li>
          <li>
            <a class="dropdown-trigger" href="#" data-target="dropdown-menu">Categories<i class="material-icons right">arrow_drop_down</i></a>
          </li>
          @if(empty(Auth::check()))
          <li><a href="{{ url('/login') }}">Login</a></li>
          @else
          <li>
            <a class="dropdown-trigger" href="" data-target="dropdown-menu1">
              <i class="large material-icons left">account_box</i>
              {{ auth()->user()->name }}
              <i class="material-icons right">arrow_drop_down</i>
            </a>
          </li>
          @endif
        </ul>
        <ul id="dropdown-menu" class="dropdown-content">
          <?php 
            $categoriesAll = \App\Category::where(['parent_id'=>0])->get();
          ?>
          @foreach($categoriesAll as $category)
          <li><a href="{{ asset('/events/'.$category->url) }}">{{ $category->name }}</a></li>
          @endforeach
        </ul>
        <ul id="dropdown-menu1" class="dropdown-content">
          <li><a href="{{ url('/account') }}">Profile</a></li>
          <li><a href="{{ url('/messages') }}">Messages</a></li>
          <li><a href="{{ url('/itinerary') }}">Itinerary
            @if(!empty(Auth::check()))  
            <?php 
            $tag = \App\Tag::where(['user_id'=>Auth::user()->id, 'seen'=>0])->count();
            $itiCount = \App\Reservation::where(['current_id'=>Auth::user()->id, 'seen'=>0])->count(); 
            ?>
            @if($itiCount > 0 || $tag > 0)
            <span class="new badge red right" data-badge-caption="New"></span>
            @endif
            @endif
          </a></li>
          <!-- <li><a href="{{ url('/my-reservations') }}">Bookings</a></li> -->
          <li><a href="{{ url('/user-logout') }}">Logout</a></li>
        </ul>

        <ul id="dropdown-menu2" class="dropdown-content">
          @foreach($categoriesAll as $category)
          <li><a href="{{ asset('/events/'.$category->url) }}">{{ $category->name }}</a></li>
          @endforeach
        </ul>
        <ul id="dropdown-menu3" class="dropdown-content">
          <li><a href="{{ url('/account') }}">Profile</a></li>
          <li><a href="{{ url('/messages') }}">Messages</a></li>
          <li><a href="{{ url('/itinerary') }}">Itinerary
            @if(!empty(Auth::check()))  
            <?php 
            $tag = \App\Tag::where(['user_id'=>Auth::user()->id, 'seen'=>0])->count();
            $itiCount = \App\Reservation::where(['current_id'=>Auth::user()->id, 'seen'=>0])->count(); 
            ?>
            @if($itiCount > 0 || $tag > 0)
            <span class="new badge red right" data-badge-caption="New"></span>
            @endif
            @endif
          </a></li>
          <li><a href="{{ url('/my-reservations') }}">Bookings</a></li>
          <li><a href="{{ url('/user-logout') }}">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<ul class="sidenav" id="mobile-nav">
  <li><a href="{{ url('/') }}">Home</a></li>
  <li><a href="#">About</a></li>
  <li>
    <a class="dropdown-trigger" href="#" data-target="dropdown-menu2">Categories<i class="material-icons right">arrow_drop_down</i></a>
  </li>
  @if(empty(Auth::check()))
  <li><a href="{{ url('/login') }}">Login</a></li>
  @else
  <li>
    <a class="dropdown-trigger" href="" data-target="dropdown-menu3">
      <i class="small material-icons left">account_box</i>
      {{ auth()->user()->name }}
      <i class="material-icons right">arrow_drop_down</i>
    </a>
  </li>
  @endif
</ul>