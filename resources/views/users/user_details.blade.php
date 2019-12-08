@extends('layouts.frontLayout1.front_design')
@section('content')
<!-- Section: Contact -->
<section id="contact" class="section section-contact scrollspy">
  <div class="container">
    <div class="row grey lighten-1 hoverable">
      <div class="col s12 m6">
        <div class="card-panel teal white-text center">
          <i class="material-icons">email</i>
          <h5>Contact Us For Booking</h5>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium fugit tempore hic enim possimus molestias
          quisquam impedit corrupti eveniet.</p>
        </div>
        <ul class="collection with-header">
          <li class="collection-header">
            <h4>{{ $userDetails->name }},  {{ $userDetails->email }}</h4>
          </li>
          <li class="collection-item">Travelville Agency</li>
          <li class="collection-item">555 Beach Rd, Suite 33</li>
          <li class="collection-item">Miami, FL 55555</li>
        </ul>
      </div>
      <div class="col s12 m6">
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
        <div class="card-panel grey lighten-3">
          <h5>Send Message</h5>
          <div class="row">
            <?php  
              if (!empty($_GET['encoded_message'])) {
                $decoded_message = decrypt($_GET['encoded_message']);
              }
            ?>
            <form class="col s12" action="{{ url('user-details/'.$userDetails->id) }}" method="post">{{ csrf_field() }}
              <div class="row" style="height: 200px; overflow: scroll;">
                <div class="input-field col s12">
                  <textarea id="textarea1" name="message" required="" class="materialize-textarea">
                    <?php  
                      if(!empty($decoded_message)){
                        echo "\n\n\n--------- $userDetails->name wrote:\n";
                        echo $decoded_message;
                      }
                    ?>
                  </textarea>
                  <label for="textarea1">Message</label>
                </div>
              </div>
              <input type="submit" value="Send Message" class="btn">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
