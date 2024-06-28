<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/animate.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/bootstrap-submenu.css") }}">

    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/bootstrap-select.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/magnific-popup.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/daterangepicker.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/admin/leaflet.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ asset("assets/css/admin/map.css") }}" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/fonts/font-awesome/css/font-awesome.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/fonts/flaticon/font/flaticon.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/fonts/linearicons/style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/jquery.mCustomScrollbar.css") }}">

    @stack("header")

    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/slick.css") }}">

    <!-- Custom stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/style.css") }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset("assets/css/admin/skins/default.css") }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css"
      href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,300,700">
    <link rel="stylesheet" type="text/css"
      href="https://fonts.googleapis.com/css?family=Dosis%7CMontserrat:200,300,400,500,600,700,800,900%7CNunito+Sans:200,300,400,600,700,800,900">

    <script src="https://cdn.tiny.cloud/1/yrqv9l2ukvxz17q6fnqs5bgfm1vzbtogf8s8e5yrwaqpwy29/tinymce/7/tinymce.min.js"
      referrerpolicy="origin"></script>

    <style>
      a {
        text-decoration: none;
      }
    </style>
  </head>

  <body>
    <div class="page_loader"></div>

    <!-- Main header start -->
    <nav class="navbar navbar-light" style="background-color: #e3f2fd;">
      <div class="container">
        <a class="navbar-brand" href="/">
          <img src="{{ asset("assets/img/logos/luwoap-dark.png") }}" alt="logo" width="150" height="auto"
            class="d-inline-block align-text-top">
        </a>
      </div>
    </nav>
    <!-- Main header end -->
    <br>
    <br>

    <!-- Dashbord start -->
    <div class="dashboard content-area-16">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="dashboard-nav-2 clearfix">
              <div class="header">
                <div class="header-inner clip-home">
                  <h2>{{ Auth::user()->name }}</h2>
                  <h4>Admin</h4>
                </div>
                <div class="profile-photo">
                  <div class="profile-photo-inner">
                    <img src="{{ asset("assets/img/avatar/avatar.jpg") }}" alt="avatar" class="img-fluid use-ing">
                  </div>
                </div>
              </div>
              <div class="detail">
                @if (Auth::user()->role == "admin")
                  <h4>Incoming</h4>
                  <ul>
                    <li><a href="/incoming-requests"><i class="lnr lnr-envelope"></i> Requests </a>
                    </li>
                    <li><a href="/bookings"><i class="lnr lnr-calendar-full"></i> Bookings</a></li>
                  </ul>
                @endif
                <h4>Listings</h4>
                <ul>
                  <li><a href="#"><i class="lnr lnr-heart"></i>Favorite Properties</a></li>
                  @if (Auth::user()->role == "admin")
                    <li>
                      <a href="/manage-properties"><i class="lnr lnr-home"></i>My
                        Properties</a>
                    </li>
                    <li><a href="/submit-property"><i class="lnr lnr-plus-circle"></i>Submit Property</a></li>
                  @endif
                </ul>
                @if (Auth::user()->role == "admin")
                  <h4>Posts</h4>
                  <ul>
                    <li><a href="/create-post"><i class="lnr lnr-file-add"></i>Create Post</a></li>
                    <li><a href="/all-posts"><i class="lnr lnr-layers"></i>My Posts</a></li>
                  </ul>
                @endif
                <ul class="pb-3">
                  <h4>Account</h4>
                  <li><a href="/user-profile"><i class="lnr lnr-user"></i>My Profile</a></li>
                  <li><a href="#" id="logoutBtn"><i class="lnr lnr-exit"></i> Logout </a></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="main-content-container" class="col-lg-8 col-md-12 col-sm-12">
            @yield("content")
          </div>
        </div>
      </div>
    </div>
    <!-- Dashbord end -->

    <!-- logout form -->
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
    <script src="{{ asset("assets/js/jquery.filterizr.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.magnific-popup.min.js") }}"></script>
    <script src="{{ asset("assets/js/modernizr.custom.js") }}"></script>
    <script src="{{ asset("assets/js/boxes-component.js") }}"></script>
    <script src="{{ asset("assets/js/boxes-core.js") }}"></script>
    <script src="{{ asset("assets/js/app.js") }}"></script>

    @stack("scripts")

    <script>
      tinymce.init({
        selector: 'textarea',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | align lineheight | checklist numlist bullist indent outdent | removeformat',
      });
    </script>

    <script>
      $(document).ready(function() {
        // Initialize active link based on current URL on page load
        var currentUrl = window.location.pathname;
        $('.dashboard-nav-2 ul li a[href="' + currentUrl + '"]').addClass('active');
      });
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        if ($(document).find('#liveToast').length > 0) {
          var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
          liveToast.show();
        }
      });
    </script>

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

</html>
