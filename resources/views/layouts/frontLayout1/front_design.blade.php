<!DOCTYPE html>
<html>

<head>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/main.css') }}">
  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl"
  crossorigin="anonymous"></script>
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
  @mapstyles
  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edutrip</title>
</head>

<body id="home" class="scrollspy">
  @include('layouts.frontlayout1.front_header')
  @yield('content')
  
  @include('layouts.frontlayout1.front_footer')

  <!--JavaScript at end of body for optimized loading-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
  
  @mapscripts
  <script>
    // Sidenav
    const sideNav = document.querySelector('.sidenav');
    M.Sidenav.init(sideNav, {});

    // Slider
    const slider = document.querySelector('.slider');
    M.Slider.init(slider, {
      indicators: false,
      height: 500,
      transition: 500,
      interval: 6000
    });

    // Autocomplete
    // const ac = document.querySelector('.autocomplete');
    // M.Autocomplete.init(ac, {
    //   data: {
    //     "Aruba": null,
    //     "Cancun Mexico": null,
    //     "Hawaii": null,
    //     "Florida": null,
    //     "California": null,
    //     "Jamacia": null,
    //     "Europe": null,
    //   }
    // });

    // Material Boxed
    const mb = document.querySelectorAll('.materialboxed');
    M.Materialbox.init(mb, {});

    // ScrollSpy
    const ss = document.querySelectorAll('.scrollspy');
    M.ScrollSpy.init(ss, {});

    // Dropdown
    const elemsDropdown = document.querySelectorAll(".dropdown-trigger");
    const instancesDropdown = M.Dropdown.init(elemsDropdown, {
      coverTrigger: false
    });

    $(document).ready(function(){
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        minDate: new Date()
      });
      $('.tabs').tabs();
      $('.modal').modal();
      $('.tooltipped').tooltip();
      $('.timepicker').timepicker();
      $('select').formSelect();
      $('#password').keyup(function(){
        var current_pwd = $(this).val();
        $.ajax({
          type:'post',
          url:'/check-user-pwd',
          data:{current_pwd:current_pwd},
          success:function(resp){
            alert(resp);
          },error:function(){
            alert("error");
          }
        });
      });
    });
    function add() {
      var x = parseInt(document.getElementById("a").value);
      var y = parseInt(document.getElementById("b").value)
      document.getElementById("c").value = x * y;
    }
    function myFunction() {
      if(!confirm("Are You Sure to delete this?"))
        event.preventDefault();
    }
  </script>
  <script src="https://js.stripe.com/v3/"></script>
  <script>
    // Create a Stripe client.
    var stripe = Stripe('pk_test_d38q2PcTA7bcgKIX8mf7HTUv00244vsptv');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
      style: style,
      hidePostalCode: true
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();

      var options = {
        name: document.getElementById('name_on_card').value,
        address_line1: document.getElementById('address').value,
        address_city: document.getElementById('city').value,
        address_state: document.getElementById('province').value,
        address_zip: document.getElementById('postalcode').value
      }

      stripe.createToken(card, options).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);

      // Submit the form
      form.submit();
    }
  </script>
</body>

</html>