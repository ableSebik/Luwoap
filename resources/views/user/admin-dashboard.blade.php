<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- External CSS libraries -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/bootstrap.min.css") }}">
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

    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/admin/slick.css") }}">

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
    @stack("header")
    {{-- @vite(["resources/css/app.css", "resources/js/app.js"]) --}}
  </head>

  <body>
    <div class="page_loader"></div>

    <!-- Main header start -->
    <header class="main-header header-transparent sticky-header">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand logo" href="/">
            <img src="{{ asset("assets/img/avatar/avatar-5.jpg") }}" alt="logo">
          </a>
        </nav>
      </div>
    </header>
    <!-- Main header end -->
    <br>
    <br>
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
                    <img src="{{ asset("assets/img/avatar/avatar-5.jpg") }}" alt="avatar" class="img-fluid use-ing">
                  </div>
                </div>
              </div>
              <div class="detail">
                <ul>
                  @if (auth()->check() ? Auth::user()->role : "admin")
                    <li><a href="incoming-requests"><i class="flaticon-mail"></i> Requests </a>
                    </li>
                    <li><a href="/bookings"><i class="flaticon-calendar"></i> Bookings</a></li>
                    <li>
                      <a href="/manage-properties"><i class="flaticon-empire-state-building"></i>My
                        Properties</a>
                    </li>
                    <li><a href="#"><i class="flaticon-heart"></i>Favorite Properties</a></li>
                    <li><a href="/submit-property"><i class="flaticon-plus"></i>Submit Property</a></li>
                    <li><a href="/create-post"><i class="fa fa-newspaper-o"></i>Create Post</a></li>
                  @endif

                  <li><a href="/user-profile"><i class="flaticon-male"></i>My Profile</a></li>
                  <li><a id="logoutBtn">Logout </a></li>
                </ul>
              </div>
            </div>
          </div>
          <div id="main-content-container" class="col-lg-8 col-md-12 col-sm-12">
            {{-- <div class="page_loader_local"></div> --}}
            @yield("content")
          </div>
        </div>
      </div>
    </div>
    <!-- Dashbord end -->

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
      <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 999999999999">
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
    <script src="{{ asset("assets/js/jquery.mb.YTPlayer.js") }}"></script>
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
        var liveToast = new bootstrap.Toast(document.getElementById('liveToast'));
        liveToast.show();
      });
    </script>

    @stack("scripts")

</html>
