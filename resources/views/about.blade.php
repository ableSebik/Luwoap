@extends("layouts.app")

@section("content")
  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>About Us</h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">About Us</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->

  <!-- About city estate start -->
  <div class="about-real-estate  content-area-5 bg-grea-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <div class="about-text clearfix">
            <h3>Welcome to LUWOAP</h3>
            <p>
              Introducing Luxury Units for Well Organized Accommodation Properties (LUWOAP): a beacon of excellence in the
              realm of real estate. Born in 2021 as a hostel broker at the University of Ghana, LUWOAP has since burgeoned
              into a distinguished provider of diverse accommodation solutions in Accra, setting new standards along the
              way.
            </p>
            <p>
              LUWOAP was founded to revolutionize the housing industry by providing accommodation for both short-term
              stays and long-term investments. Our team consists of experienced professionals who possess an in-depth
              knowledge of the local real estate market. As a result, LUWOAP has established itself as a trusted and
              distinguished organization known for its reliability.
            </p>
            <div class="bottom">
              <div class="signature"><img loading="lazy" src="{{ asset("assets/img/jed.png") }}" alt="signature"></div>
              <div class="left ml-3">
                <h5 class="name">Jedidiah Apenteng</h5>
                <p class="post mb-0">Chief Executive Officer</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12">
          <div class="about-img-section">
            <div class="image-box sssa">
              <div class="image-1"><img loading="lazy" src="{{ asset("assets/img/about-bg.png") }}" class="w-100"
                  alt="photo"></div>
            </div>
            <div class="about-box-Experience">
              <img loading="lazy" src="{{ asset("assets/img/about-shape.png") }}" alt="image" class="img-fluid">
              <div class="content">
                <h3>3+</h3>
                <p class="mb-0">Years of Experience</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- About city estate end -->

  <!-- Our team start -->
  {{-- <div class="our-team comon-slick content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title">
        <h2>Our Team</h2>
      </div>
      <div class="slick row comon-slick-inner"
        data-slick='{"slidesToShow": 4, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 1}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
        <div class="item slide-box">
          <div class="team-1">
            <div class="team-thumb">
              <a href="#">
                <img loading="lazy" src="img/avatar/avatar-6.jpg" alt="team" class="img-fluid">
              </a>
              <div class="team-social flex-middle">
                <div class="team-overlay"></div>
                <div class="team-social-inner">
                  <a rel="nofollow" href="#" class="facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="google">
                    <i class="fa fa-google" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="linkedin">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="team-info">
              <h4>
                <a href="#">John Pitarshon</a>
              </h4>
              <p>Creative Director</p>
            </div>
          </div>
        </div>
        <div class="item slide-box">
          <div class="team-1">
            <div class="team-thumb">
              <a href="#">
                <img loading="lazy" src="img/avatar/avatar-7.jpg" alt="team" class="img-fluid">
              </a>
              <div class="team-social flex-middle">
                <div class="team-overlay"></div>
                <div class="team-social-inner">
                  <a rel="nofollow" href="#" class="facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="google">
                    <i class="fa fa-google" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="linkedin">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="team-info">
              <h4>
                <a href="#">Martin Smith</a>
              </h4>
              <p>Web Developer</p>
            </div>
          </div>
        </div>
        <div class="item slide-box">
          <div class="team-1">
            <div class="team-thumb">
              <a href="#">
                <img loading="lazy" src="img/avatar/avatar-8.jpg" alt="team" class="img-fluid">
              </a>
              <div class="team-social flex-middle">
                <div class="team-overlay"></div>
                <div class="team-social-inner">
                  <a rel="nofollow" href="#" class="facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="google">
                    <i class="fa fa-google" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="linkedin">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="team-info">
              <h4>
                <a href="#">Maria Blank</a>
              </h4>
              <p>Office Manager</p>
            </div>
          </div>
        </div>
        <div class="item slide-box">
          <div class="team-1">
            <div class="team-thumb">
              <a href="#">
                <img loading="lazy" src="img/avatar/avatar-5.jpg" alt="team" class="img-fluid">
              </a>
              <div class="team-social flex-middle">
                <div class="team-overlay"></div>
                <div class="team-social-inner">
                  <a rel="nofollow" href="#" class="facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="google">
                    <i class="fa fa-google" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="linkedin">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="team-info">
              <h4>
                <a href="#">Karen Paran</a>
              </h4>
              <p>Support Manager</p>
            </div>
          </div>
        </div>
        <div class="item slide-box">
          <div class="team-1">
            <div class="team-thumb">
              <a href="#">
                <img loading="lazy" src="img/avatar/avatar-8.jpg" alt="team" class="img-fluid">
              </a>
              <div class="team-social flex-middle">
                <div class="team-overlay"></div>
                <div class="team-social-inner">
                  <a rel="nofollow" href="#" class="facebook">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="twitter">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="google">
                    <i class="fa fa-google" aria-hidden="true"></i>
                  </a>
                  <a rel="nofollow" href="#" class="linkedin">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="team-info">
              <h4>
                <a href="#">Maria Blank</a>
              </h4>
              <p>Office Manager</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  <!-- Our team end -->

  <!-- Counters 2 strat -->
  <div class="counters-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 border-r border-l">
          <div class="counter-box-2">
            <i class="flaticon-sale"></i>
            <h3 class="counter" style="color: #fff !important">967</h3>
            <p>Properties For Sale</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 border-r">
          <div class="counter-box-2">
            <i class="flaticon-rent"></i>
            <h3 class="counter" style="color: #fff !important">1276</h3>
            <p>Properties For Rent</p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 border-r">
          <div class="counter-box-2">
            <i class="flaticon-user"></i>
            <h3 class="counter" style="color: #fff !important">396</h3>
            <p>Satisfied Clients</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Counters 2 end -->

  <!-- Services start -->
  <div class="services content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title text-center">
        <h2>Working With The Us</h2>
        <p>Expect nothing short of Professionalism, Integrity, and Dedication.
        </p>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <div class="service-info-3 d-flex">
            <div class="icon">
              <i class="flaticon-user"></i>
            </div>
            <div class="detail align-self-center">
              <h3>
                <a>Personalized Service</a>
              </h3>
              <p>Experience the difference with our services tailored to meet your unique needs and
                preferences.</p>

              <h4>01</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="service-info-3 d-flex">
            <div class="icon">
              <i class="flaticon-empire-state-building"></i>
            </div>
            <div class="detail align-self-center">
              <h3>
                <a>Luxury Real Estate Experts</a>
              </h3>
              <p>Trust in our expertise in luxury real estate. We're your trusted partners in the
                pursuit of luxury living.</p>
              <h4>02</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="service-info-3 d-flex">
            <div class="icon">
              <i class="flaticon-discount"></i>
            </div>
            <div class="detail align-self-center">
              <h3>
                <a>Properties For Rent & Sale</a>
              </h3>
              <p>Explore our modern properties for rent and sale, from sleek apartments to
                contemporary homes.</p>
              <h4>03</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Services end -->
@endsection
