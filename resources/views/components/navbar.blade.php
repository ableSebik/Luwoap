<!-- Main header start -->
<header class="main-header sticky-header header-with-top" id="main-header-2">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand logos" href="/">
        {{-- <x-application-logo class="f-logo" /> --}}
        <img src="{{ asset("assets/img/logos/rohnvest-03.png") }}" alt="logo">
      </a>
      <button class="navbar-toggler" id="drawer" type="button">
        <span class="fa fa-bars"></span>
      </button>
      <div class="navbar-collapse collapse w-100 justify-content-end" id="navbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">
              Home
            </a>
          </li>
          <li class="nav-item dropdown megamenu-li">
            <a class="nav-link dropdown-toggle" href="/all-properties" id="dropdown01" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">Properties</a>
            <div class="dropdown-menu megamenu" aria-labelledby="dropdown01">
              <div class="megamenu-area">
                <div class="row sobuz">
                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="megamenu-section">
                      <h6 class="megamenu-title">Offer Type</h6>
                      <a class="dropdown-item" href="{{ route("buy.prop") }}">For Sale</a>
                      <a class="dropdown-item" href="{{ route("rent.prop") }}">Rentals</a>
                      <a class="dropdown-item" href="{{ route("lease.prop") }}">Lease</a>

                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="megamenu-section">
                      <h6 class="megamenu-title">Category</h6>
                      <a class="dropdown-item" href="#">Apartment</a>
                      <a class="dropdown-item" href="#">Hostel</a>
                      <a class="dropdown-item" href="#">Air BnB</a>
                      <a class="dropdown-item" href="#">Office Spaces</a>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="megamenu-section">
                      <h6 class="megamenu-title">Category</h6>
                      <a class="dropdown-item" href="#">Luxury App</a>
                      <a class="dropdown-item" href="#">Hotel</a>
                      <a class="dropdown-item" href="#">Guest House</a>
                      <a class="dropdown-item" href="#">Commercial Space</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/about">
              About Us
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="/blog">
              Blog
            </a>
          </li>
          @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route("login") }}">
                <i class="fa fa-user-o"></i>
                Sign In
              </a>
            </li>
          @endguest
          @auth
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="/user-profile" id="navbarDropdownMenuLink7" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle fa-lg"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li>
                  <a class="dropdown-item" href="#">Hi,
                    {{ Auth::user()->name }}
                  </a>
                </li>
                <hr>
                <li><a class="dropdown-item" href="/user-profile">Profile</a></li>
                <li>
                  <a class="dropdown-item" id="logoutBtn">Logout </a>
                </li>
              </ul>
            </li>
          @endauth
          @auth
            @if (auth()->check() ? Auth::user()->role : "admin")
              <li class="nav-item sp">
                <a href="/submit-property" class="nav-link link-color"><i class="fa fa-plus"></i> Submit
                  Property</a>
              </li>
            @endif
          @endauth
        </ul>
      </div>
    </nav>
  </div>
</header>
<!-- Main header end -->

<!-- Sidenav start -->
<nav id="sidebar" class="nav-sidebar">
  <!-- Close btn-->
  <div id="dismiss">
    <i class="fa fa-close"></i>
  </div>
  <div class="sidebar-inner">
    <div class="sidebar-logo">
      <x-application-logo class="f-logo" />
    </div>
    <div class="sidebar-navigation">
      <ul class="menu-list">
        <li><a href="/" class="active pt0">Home</a>
        </li>
        <li>
          <a href="#">Properties <em class="fa fa-chevron-down"></em></a>
          <ul>
            <li>
              <a href="#">Offer Type <em class="fa fa-chevron-down"></em></a>
              <ul>
                <li><a href="{{ route("buy.prop") }}">For Sale</a></li>
                <li><a href="{{ route("rent.prop") }}">For Rent</a></li>
                <li><a href="{{ route("lease.prop") }}">For Lease</a></li>
              </ul>
            </li>
            <li>
              <a href="#">Category <em class="fa fa-chevron-down"></em></a>
              <ul>
                <li><a href="#">Apartment</a></li>
                <li><a href="#">Hostel</a></li>
                <li><a href="#">Air BnB</a></li>
                <li><a href="#">Office Spaces</a></li>
                <li><a href="#">Luxury App</a></li>
                <li><a href="#">Hotel</a></li>
                <li><a href="#">Guest House</a></li>
                <li><a href="#">Commercial Space</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li>
          <a href="/about">About Us </a>
        </li>
        <li>
          <a href="/blog">Blog </a>
        </li>
        @guest
          <li>
            <a href="/{{ route("login") }}"><i class="fa fa-user-o"></i> Sign In </a>
          </li>
        @endguest

        @auth
          <li><a href="#">My Account <em class="fa fa-chevron-down"></em></a>
            <ul>
              <li><a href="">Hi,
                  {{ Auth::user()->name }}</a></li>
              <li><a href="/dashboard">Profile</a></li>
              <li>
                <a id="logoutBtn">Logout </a>
              </li>
            </ul>
          </li>

          @if (auth()->check() ? Auth::user()->role : "admin")
            <li>
              <a href="/submit-property" class="nav-link link-color">
                <i class="fa fa-plus"></i>
                Submit Property</a>
            </li>
          @endif
        @endauth

      </ul>
    </div>
    <div class="get-in-touch">
      <h3 class="heading">Get in Touch</h3>
      <div class="get-in-touch-box d-flex">
        <i class="flaticon-phone"></i>
        <div class="detalis">
          <a href="tel:+233201492986">+233 201 492 986</a>
        </div>
      </div>
      <div class="get-in-touch-box d-flex">
        <i class="flaticon-mail"></i>
        <div class="detalis">
          <a href="mailto:info@luwoap.com">info@luwoap.com</a>
        </div>
      </div>

    </div>
    <div class="get-social">
      <h3 class="heading">Get Social</h3>
      <a href="#" class="facebook-bg">
        <i class="fa fa-facebook"></i>
      </a>
      <a href="#" class="twitter-bg">
        <i class="fa fa-twitter"></i>
      </a>
      <a href="#" class="instagram-bg">
        <i class="fa fa-instagram"></i>
      </a>
      <a href="#" class="linkedin-bg">
        <i class="fa fa-linkedin"></i>
      </a>
    </div>
  </div>
</nav>
<!-- Sidenav end -->
