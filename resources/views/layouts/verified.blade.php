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
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/modern-refresh.css") }}">

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
    {{-- @vite(["resources/css/app.css", "resources/js/app.js"]) --}}
  </head>

  <body>
    <!--<div class="page_loader"></div>-->
    <!-- Page Content -->
    <main>
      @yield("content")
    </main>

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
    <script src="{{ asset("assets/js/jquery.magnific-popup.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.countdown.js") }}"></script>
    <script src="{{ asset("assets/js/modernizr.custom.js") }}"></script>
    <script src="{{ asset("assets/js/boxes-component.js") }}"></script>
    <script src="{{ asset("assets/js/boxes-core.js") }}"></script>
    <script src="{{ asset("assets/js/maps.js") }}"></script>
    <script src="{{ asset("assets/js/app.js") }}"></script>

    @stack("scripts")
  </body>

  {{-- <x-flash-message></x-flash-message> --}}

</html>
