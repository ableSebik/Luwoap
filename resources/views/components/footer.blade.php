{{-- <footer class="main-footer-1">
  <div class="container footer-inner">
    <div class="row">
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
        <div class="footer-item clearfix">
          <x-application-logo class="f-logo" />
          <div class="text">
            <p class="mb-0">Today, LUWOAP has evolved into a leading brokerage company, specializing in a diverse range
              of properties including real estate houses for both sales and rent, hostels, apartments, Airbnb rentals,
              and hotels.
            </p>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
        <div class="footer-item">
          <h4>Contact Us</h4>
          <ul class="contact-info">
            <li>
              <i class="flaticon-mail"></i><a href="mailto:info@luwoap.com">info@luwoap.com</a>
            </li>
            <li>
              <i class="flaticon-pin"></i><a>Accra</a>
            </li>
            <li>
              <i class="flaticon-phone"></i><a href="tel:+233201492986">+233 20 149 2986</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
        <div class="footer-item">
          <h4>
            Useful Links
          </h4>
          <ul class="links">
            <li>
              <a href="" class="link-inner"><span> Home</span></a>
            </li>
            <li>
              <a href="about" class="link-inner"><span> About Us</span></a>
            </li>
            <li>
              <a href="all-properties" class="link-inner"><span> Properties</span></a>
            </li>
            <li>
              <a href="blog" class="link-inner"><span> Blog</span></a>
            </li>
            <li>
              <a href="login" class="link-inner"><span> Sign In</span></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
        <div class="footer-item clearfix">
          <h4>Subscribe</h4>
          <div class="Subscribe-box">
            <p>Sign up for newsletter and get latest news and update</p>
            <form class="form-inline d-flex" action="{{ route("subscribe") }}" method="POST">
              @csrf
              <input class="form-control" type="email" id="email" name="email" placeholder="Email Address...">
              <button class="btn btn-theme" type="submit"><i class="fa fa-paper-plane"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="sub-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <p class="copy">© 2024 <a href="">LUWOAP.</a> All Rights Reserved.</p>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="social-media clearfix">
            <div class="social-list">
              <div class="icon facebook">
                <div class="tooltip">Facebook</div>
                <span><i class="fa fa-facebook"></i></span>
              </div>
              <div class="icon twitter">
                <div class="tooltip">Twitter</div>
                <span><i class="fa fa-twitter"></i></span>
              </div>
              <div class="icon instagram">
                <div class="tooltip">Instagram</div>
                <span><i class="fa fa-instagram"></i></span>
              </div>
              
              <div class="icon youtube mr-0">
                <div class="tooltip">Youtube</div>
                <span><i class="fa fa-youtube"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer> --}}
<footer class="main-footer-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="logo-image">
          <a href=""><img src="{{ asset("assets/img/logos/luwoap-wt.png") }}" alt="logo"></a>
        </div>
        <div class="footer-menu">
          <ul>
            <li class="li">
              <a href="/">Home</a>
            </li>
            <li class="li">
              <a href="all-properties">Properties</a>
            </li>
            <li class="li">
              <a href="blog">Blog</a>
            </li>
            <li class="li">
              <a href="contact">Contact</a>
            </li>
            <li class="li">
              <a href="about">About Us</a>
            </li>
            <li class="li">
              <a href="login">Login</a>
            </li>
          </ul>
        </div>
        <div class="social-media clearfix">
          <div class="social-list">
            <div class="icon facebook">
              <div class="tooltip">Facebook</div>
              <span><i class="fa fa-facebook"></i></span>
            </div>
            <div class="icon twitter">
              <div class="tooltip">Twitter</div>
              <span><i class="fa fa-twitter"></i></span>
            </div>
            <div class="icon tiktok">
              <div class="tooltip">Tiktok</div>
              <span><i class="fa fa-tiktok"></i></span>
            </div>
            <div class="icon instagram">
              <div class="tooltip">Instagram</div>
              <span><i class="fa fa-instagram"></i></span>
            </div>
            <div class="icon youtube mr-0">
              <div class="tooltip">Youtube</div>
              <span><i class="fa fa-youtube"></i></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="copy-right">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p> © 2024 LUWOAP. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>
