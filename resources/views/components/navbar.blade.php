<!-- Top header 3 start -->
<div class="top-header-3 d-none d-lg-block" id="top-header-4">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-3">
        <div class="top-logo">
          <a href="/"><img src="{{ asset("assets/img/logos/luwoap-dark.png") }}" alt="luwoap-logo"></a>
        </div>
      </div>
      <div class="col-lg-9 col-md-9">
        <div class="top-header-inner">
          <div class="top-contact-item">
            <i class="bi bi-geo-alt"></i>
            <div class="content">
              <p>Our Location</p>
              <a href="#" target="blank">Adenta, Accra</a>
            </div>
          </div>
          <div class="top-contact-item">
            <i class="bi bi-envelope-open"></i>
            <div class="content">
              <p>Online Support</p>
              <a href="mailto:info@luwoap.com">info@luwoap.com</a>
            </div>
          </div>
          <div class="top-contact-item tci2">
            <i class="bi bi-telephone-inbound"></i>
            <div class="content">
              <p>Call Us </p>
              <a href="tel:+233-20-149-2986">+233-20-149-2986</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Top header 3 end -->

<!-- Main header start -->
<header class="main-header sticky-header header-fixed main-header-5" id="main-header-6">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="sidebar-logo d-md-none">
        <img src="{{ asset("assets/img/logos/luwoap-wt.png") }}" alt="sidebarlogo">
      </div>
      <button class="navbar-toggler" id="drawer" type="button">
        <span class="fa fa-bars"></span>
      </button>
      <div class="navbar-collapse collapse w-100" id="navbar">

        <ul class="navbar-nav w-100 ">
          <li class="nav-item">
            <a class="nav-link" href="/">
              Home
            </a>
          </li>
          <li class="nav-item dropdown megamenu-li">
            <a class="nav-link dropdown-toggle" href="/properties" id="dropdown01" data-toggle="dropdown"
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
                      <a class="dropdown-item" href="{{ route("apartment.prop") }}">Apartment</a>
                      <a class="dropdown-item" href="{{ route("hostel.prop") }}">Hostel</a>
                      <a class="dropdown-item" href="{{ route("airbnb.prop") }}">Air BnB</a>
                      <a class="dropdown-item" href="{{ route("office.prop") }}">Office Spaces</a>
                    </div>
                  </div>
                  <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="megamenu-section">
                      <h6 class="megamenu-title">Category</h6>
                      <a class="dropdown-item" href="{{ route("luxury.prop") }}">Luxury Apartment</a>
                      <a class="dropdown-item" href="{{ route("hotel.prop") }}">Hotel</a>
                      <a class="dropdown-item" href="{{ route("guest.prop") }}">Guest House</a>
                      <a class="dropdown-item" href="{{ route("commercial.prop") }}">Commercial Space</a>
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
          <li class="nav-item ">
            <a class="nav-link" href="/contact">
              Contact
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="/blog">
              Blog
            </a>
          </li>
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

        </ul>

        <ul class="nav navbar-nav w-50 justify-content-end">
          @guest
            <li class="nav-item">
              <a class="nav-link h-icon" href="{{ route("login") }}">
                <i class="fa fa-user-o"></i>
                Login
              </a>
            </li>
          @endguest
          @auth
            @if (auth()->check() ? Auth::user()->role : "admin")
              <li class="nav-item">
                <a href="/submit-property" class="nav-link h-icon"><i class="fa fa-plus"></i> Submit
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
      <img src="{{ asset("assets/img/logos/luwoap-dark.png") }}" alt="sidebarlogo">
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
            <a href="login"><i class="fa-brands fa-tiktok"></i> Sign In </a>
          </li>
        @endguest

        @auth
          <li><a>My Account <em class="fa fa-chevron-down"></em></a>
            <ul>
              <li><a href="">Hi,
                  {{ Auth::user()->name }}</a></li>
              <li><a href="/user-profile">Profile</a></li>
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
      <a href="https://www.tiktok.com/@luwoap.accommodat" class="tiktok-bg">
        <i class="fa fa-tiktok"></i>
      </a>
      <a href="https://www.instagram.com/accommodation_portal/" class="instagram-bg">
        <i class="fa fa-instagram"></i>
      </a>
      <a href="https://www.linkedin.com/in/luwoap-properties-3a1bb7304/" class="linkedin-bg">
        <i class="fa fa-linkedin"></i>
      </a>
    </div>
  </div>
</nav>
<!-- Sidenav end -->
