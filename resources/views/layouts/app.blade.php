<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- imported links -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">
    <link rel="stylesheet" href="{{ asset('assets/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mediaelementplayer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fl-bigmug-line.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <div class="col-4 col-md-4 col-lg-8">
                        <nav class="site-navigation text-right text-md-right" role="navigation">

                            <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                                    class="site-menu-toggle js-menu-toggle text-white"><span
                                        class="icon-menu h3"></span></a></div>

                            <ul class="site-menu js-clone-nav d-none d-lg-block">
                                <li class="active">
                                    <a href="index.html">Home</a>
                                </li>
                                <li><a href="buy.html">Buy</a></li>
                                <li><a href="rent.html">Rent</a></li>
                                <li class="has-children hidden sm:flex sm:items-center sm:ms-6">
                                    <a href="properties.html">Properties</a>
                                    <ul class="dropdown">
                                        <li><a href="#">Condo</a></li>
                                        <li><a href="#">Property Land</a></li>
                                        <li><a href="#">Commercial Building</a></li>

                                    </ul>
                                </li>
                                <li><a href="/about">About</a></li>
                                <li><a href="contact.html">Contact</a></li>

                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                    @endif
                                    {{-- @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @endif --}}
                                @else
                                    <li class="has-children hidden sm:flex sm:items-center sm:ms-6">
                                        <a href="#">
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown ">
                                            <li class="dropdown-item">
                                                <x-dropdown-link :href="route('profile.edit')">
                                                    {{ __('Profile') }}
                                                </x-dropdown-link>
                                            </li>
                                            <li class="dropdown-item">
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf

                                                    <x-dropdown-link :href="route('logout')"
                                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                        {{ __('Log Out') }}
                                                    </x-dropdown-link>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endguest
                            </ul>
                        </nav>
                    </div>


                </div>
            </div>
        </div>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>


        <footer class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-5">
                            <h3 class="footer-heading mb-4">About Homeland</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe pariatur
                                reprehenderit
                                vero atque, consequatur id ratione, et non dignissimos culpa? Ut veritatis, quos
                                illum
                                totam quis blanditiis, minima minus odio!</p>
                        </div>



                    </div>
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h3 class="footer-heading mb-4">Navigations</h3>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">Home</a></li>
                                    <li><a href="#">Buy</a></li>
                                    <li><a href="#">Rent</a></li>
                                    <li><a href="#">Properties</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <ul class="list-unstyled">
                                    <li><a href="#">About Us</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Terms</a></li>
                                </ul>
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h3 class="footer-heading mb-4">Follow Us</h3>

                        <div>
                            <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                        </div>



                    </div>

                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved
                        </p>
                    </div>

                </div>
            </div>
        </footer>
    </div>


    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/mediaelement-and-player.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/js/aos.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <x-flash-message></x-flash-message>
</body>

</html>
