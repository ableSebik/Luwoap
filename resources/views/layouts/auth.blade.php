<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- imported links -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">
    <link rel="stylesheet" href="{{ asset("assets/fonts/icomoon/style.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/magnific-popup.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/jquery-ui.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.carousel.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/owl.theme.default.min.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/bootstrap-datepicker.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/mediaelementplayer.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/fonts/flaticon/font/flaticon.css") }}">
    <link rel="stylesheet" href="{{ asset("assets/css/fl-bigmug-line.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/aos.css") }}">

    <link rel="stylesheet" href="{{ asset("assets/css/style.css") }}">

    <!-- Scripts -->
    @vite(["resources/css/app.css", "resources/js/app.js"])
  </head>

  <body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

      {{-- imported navbar --}}
      <div class="site-navbar mt-4">
        <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-8 col-md-8 col-lg-4">
              <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Page Content -->
      <main>
        <div
          class="container min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
          <div>
            @if (Request::is("login"))
              <h1 class="mb-0">
                <span class="text-white h2 mb-0"><strong>Login</strong></span>
              </h1>
            @elseif (Request::is("register"))
              <h1 class="mb-0 text-white">
                <span class=" h2 mb-0"><strong>Register</strong></span>
              </h1>
            @elseif (Request::is("forgot-password"))
              <h1 class="mb-0 text-white">
                <span class=" h2 mb-0"><strong>Reset Password</strong></span>
              </h1>
            @else
              <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
              </a>
            @endif
          </div>

          <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            @yield("content")
          </div>
        </div>
      </main>

    </div>

    <script src="{{ asset("assets/js/jquery-3.3.1.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery-migrate-3.0.1.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery-ui.js") }}"></script>
    <script src="{{ asset("assets/js/popper.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap.min.js") }}"></script>
    <script src="{{ asset("assets/js/owl.carousel.min.js") }}"></script>
    <script src="{{ asset("assets/js/mediaelement-and-player.min.js") }}"></script>
    <script src="{{ asset("assets/js/jquery.stellar.min.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-datepicker.min.js") }}"></script>
    <script src="{{ asset("assets/js/aos.js") }}"></script>

    <script src="{{ asset("assets/js/main.js") }}"></script>

  </body>

</html>
