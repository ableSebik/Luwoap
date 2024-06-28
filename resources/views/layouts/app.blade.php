<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/animate.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap-submenu.css") }}">

    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap-select.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/magnific-popup.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/leaflet.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/map.css") }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/fonts/font-awesome/css/font-awesome.min.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="{{ asset("assets/fonts/bootstrap-icons/bootstrap-icons.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/fonts/flaticon/font/flaticon.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/fonts/linearicons/style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/jquery.mCustomScrollbar.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/dropzone.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/slick.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/normalize.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/boxes-component.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/boxes-core.css") }}">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/initial.css") }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset("assets/css/skins/default.css") }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset("assets/img/fav.ico") }}" type="image/x-icon">

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&amp;display=swap"
      rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@100;300;400;500;600;700;800;900&amp;display=swap"
      rel="stylesheet">

    @stack("header")
  </head>

  <body>
    <div class="page_loader"></div>

    <!-- Main header start -->
    <x-navbar />
    <!-- Main header end -->

    <!-- Page Content -->
    <main>
      @yield("content")

    </main>
    <!-- Intro section 2 start -->
    <div class="intro-section-2">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 col-md-12 col-sm-12">
            <div class="intro-text">
              <h3>Subscribe to Newsletter</h3>
              <p>Subscribe to get update and information. Don't worry, we won't send spam!</p>
            </div>
          </div>
          <div class="col-lg-5 col-md-12 col-sm-12">
            <div class="Subscribe-box">
              <form class="form-inline d-flex" action="{{ route("subscribe") }}" method="POST">
                @csrf
                <input class="form-control" type="email" name="email" id="email" placeholder="Email Address..."
                  required>
                <button type="submit" class="btn">Subscribe</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Intro section 2 end -->

    <!-- Footer start -->
    <x-footer />
    <!-- Footer end -->

    <div class="d-none">
      <form method="POST" action="{{ route("logout") }}" id="logoutForm">
        @csrf
        <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();"><i
            class="flaticon-logout"></i> Logout</a>
      </form>
    </div>

    @php
      $bg = "";
      if (\Session::has("success")) {
          $bg = "bg-success";
      }
      if (\Session::has("error")) {
          $bg = "bg-danger";
      }
      if (\Session::has("info")) {
          $bg = "bg-info";
      }
    @endphp
    @if (\Session::has("success") || \Session::has("error"))
      <div class="position-fixed p-3" style="bottom: 15%; right: 0; z-index: 999999">
        <div class="toast align-items-center text-white border-0 {{ $bg }}" role="alert"
          aria-live="assertive" aria-atomic="true" id="liveToast">
          <div class="d-flex">
            <div class="toast-body">
              @if (\Session::has("success"))
                {{ session("success") }}
              @elseif (\Session::has("error"))
                {{ session("error") }}
              @elseif (\Session::has("info"))
                {{ session("info") }}
              @endif
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
              aria-label="Close"></button>
          </div>
        </div>
      </div>
    @endif

    <script src="{{ asset("assets/js/bootstrap.bundle.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-submenu.js") }}"></script>
    <script src="{{ asset("assets/js/rangeslider.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-select.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.easing.1.3.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.scrollUp.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.mCustomScrollbar.concat.min.js") }}"></script>
    <script src="{{ asset("assets/js/leaflet.js") }}"></script>
    <script src="{{ asset("assets/js/leaflet-providers.js") }}"></script>
    <script src="{{ asset("assets/js/leaflet.markercluster.js") }}"></script>
    <script src="{{ asset("assets/js/slick.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.magnific-popup.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.countdown.js") }}"></script>
    <script src="{{ asset("assets/js/modernizr.custom.js") }}"></script>
    <script src="{{ asset("assets/js/boxes-component.js") }}"></script>
    <script src="{{ asset("assets/js/boxes-core.js") }}"></script>
    <script src="{{ asset("assets/js/maps.js") }}"></script>
    <script src="{{ asset("assets/js/app.js") }}"></script>

    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    @stack("scripts")

    <script>
      // Wait for the document to fully load
      document.addEventListener('DOMContentLoaded', function() {

        if ($(document).find('#logoutBtn').length > 0) {
          // Get a reference to the logout button
          var logoutBtn = document.getElementById('logoutBtn');

          // Get a reference to the logout form
          var logoutForm = document.getElementById('logoutForm');

          // Add a click event listener to the logout button
          logoutBtn.addEventListener('click', function(event) {
            // Prevent the default form submission behavior
            event.preventDefault();

            // Submit the logout form
            logoutForm.submit();
          });
        }
      });
    </script>
    <!-- JavaScript to show the toast -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        if ($(document).find('#liveToast').length > 0) {
          var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
          liveToast.show();
        }
      });
    </script>

  </body>

</html>
