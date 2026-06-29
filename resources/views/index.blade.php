@extends("layouts.app")

@section("content")
  <!-- Banner start -->
  <div class="banner" id="banner">
    <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item banner-max-height active item-bg">
          <div id="boxgallery" class="boxgallery" data-effect="effect-3">
            <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-3.jpg") }}" alt="Image 1" />
            </div>
            <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-2.jpg") }}" alt="Image 1" />
            </div>
            <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-1.jpg") }}" alt="Image 1" />
            </div>
            <div class="panel"><img loading="lazy" src="{{ asset("assets/img/banner/img-5.jpg") }}" alt="Image 1" />
            </div>
          </div>
        </div>
        <div class="carousel-caption d-flex h-100">
          <div class="carousel-content container">
            <div class="text-center bi-3">
              <div class="clearfix">
                <h3>Welcome to Your New Home</h3>
                <p>Discover a wide range of properties that fit your lifestyle and budget.</p>
              </div>
              <div class="clearfix"></div>
              {{-- search bar --}}
              <form action="{{ route("search") }}" method="get">
                @csrf
                <div class="inline-search-area isa-5 isa-992 clearfix">
                  <div class="row">
                    <div class="col-md-9 col-lg-9 col-sm-12">
                      <input required class="form-control search-fields sf" name="query"
                        placeholder="What are you looking for?">
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-12">
                      <button class="btn-5 button-theme btn-search w-100">
                        <strong>Search</strong>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

  <!-- Property Type listing -->
  <div class="" style="z-index: 99; margin-top:65px;position:relative">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12">
          <a href="{{ route("house.prop") }}" class="service-info-4-link">
            <div class="service-info-4">
              <div class="icon">
                <i class="fas fa-building"></i>
              </div>
              <div class="detail align-self-center">
                <h3>Houses for Sale/Rent</h3>
                <p>With years of experience in the real estate industry, we bring a wealth of knowledge of market trends
                  to help you find the perfect home, whether you're looking to buy or rent.
                </p>
                <span class="read-more">View Listing</span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-md-12">
          <a href="{{ route("hostel.prop") }}">
            <div class="service-info-4">
              <div class="icon">
                <i class="fas fa-hotel"></i>
              </div>
              <div class="detail align-self-center">
                <h3>Hostel Facilities</h3>
                <p>Offering top-notch hostel facilities, we ensure a comfortable and secure stay with modern amenities and
                  friendly services, tailored to meet the needs of students and travelers alike.
                </p>
                <span class="read-more">View Listing</span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-md-12">
          <a href="{{ route("airbnb.prop") }}">
            <div class="service-info-4">
              <div class="icon">
                <i class="fab fa-airbnb"></i>
              </div>
              <div class="detail align-self-center">
                <h3>Air BnB</h3>
                <p>Experience the perfect blend of comfort and convenience with our carefully curated Air BnB listings,
                  providing unique accommodations that cater to all preferences and budgets.
                </p>
                <span class="read-more">View Listing</span>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </div>

  <!-- End Property Type listing -->

  {{-- Property listings --}}
  <div class="property-section content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title-3">
        <h1>Latest Properties</h1>
        <p>BROWSE HOT OFFERS</p>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <div class="row">
            @forelse ($props as $prop)
              <div class="col-lg-4 col-md-6 col-sm-12">
                <x-property-box :prop="$prop" />
              </div>
            @empty
              <div class="col-lg-4 col-md-6 col-sm-12">
                <p class="alert alert-danger">No Properties.
                </p>
              </div>
            @endforelse
          </div>
        </div>
      </div>

      {{-- <button class="btn-5 button-theme btn-search w-100">
        <strong>Search</strong>
      </button> --}}
      <a href="/properties" class="btn-5 my-5">More Properties <i class="fa fa-angle-double-right"></i></a>
    </div>
  </div>
  {{-- End Property listings --}}

  <!-- Services start -->
  <div class="services content-area bg-grea-3">
    <div class="container">
      <!-- Main title -->
      <div class="main-title-3">
        <p>Our Expertise</p>
        <h2>Why Choose <span>Us</span></h2>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-12">
          <div class="service-info-3 d-flex">
            <div class="icon">
              <i class="flaticon-empire-state-building"></i>
            </div>
            <div class="detail align-self-center">
              <h3>Luxury Real Estate Experts</h3>
              <p>With years of experience in the real estate industry, we bring a wealth of knowledge and a keen
                understanding of market trends.
              </p>
              <a class="read-more" href="/services">Read more...</a>
              <h4>01</h4>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="service-info-3 d-flex">
            <div class="icon">
              <i class="flaticon-user"></i>
            </div>
            <div class="detail align-self-center">
              <h3>Client-Centered Approach</h3>
              <p> We believe in building lasting relationships with our clients by providing personalized services
                tailored to your unique needs.</p>
              <a class="read-more" href="/services">Read more...</a>
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
              <h3>Quality Affordable</h3>
              <p>From luxurious residences to commercial spaces. We
                have options for every lifestyle and investment goals.</p>
              <a class="read-more" href="/services">Read more...</a>
              <h4>03</h4>
            </div>
          </a>
        </div>
      </div>
    </section>

  <!-- Blog start -->
  {{-- <div class="blog comon-slick content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title-3">
        <p>Our Blog</p>
        <h2>Latest <span>News</span></h2>
      </div>
      <div class="row">
        @foreach ($recentPostsData["blogPosts"] as $recentBlogPost)
          <div class="col-lg-4 col-md-4">
            <div class="blog-2">
              <div class="blog-image">
                <img loading="lazy" src="{{ asset("storage/posts/" . $recentBlogPost->post_ft_image) }}"
                  alt="{{ $recentBlogPost->post_title }}" class="img-fluid bp">
                <div class="date-box">
                  <span>{{ $recentBlogPost->post_day }}</span>{{ $recentBlogPost->post_month }}
                </div>

    <section class="home-section home-reasons">
      <div class="container">
        <div class="home-section-heading home-section-heading-center">
          <h2>Why Choose LUWOAP Properties?</h2>
        </div>
        <div class="home-reason-grid">
          <div class="home-reason">
            <i class="bi bi-shield-check" aria-hidden="true"></i>
            <h3>Verified Listings</h3>
            <p>Every property is reviewed for your peace of mind.</p>
          </div>
          <div class="home-reason">
            <i class="bi bi-hand-thumbs-up" aria-hidden="true"></i>
            <h3>Trusted Service</h3>
            <p>We are committed to honesty and reliability.</p>
          </div>
          <div class="home-reason">
            <i class="bi bi-house-heart" aria-hidden="true"></i>
            <h3>Wide Range</h3>
            <p>From homes to hostels and shortlets, we have you covered.</p>
          </div>
          <div class="home-reason">
            <i class="bi bi-headset" aria-hidden="true"></i>
            <h3>Customer Support</h3>
            <p>Our team is here to assist every step of the way.</p>
          </div>
        </div>
      </div>
      <a href="/blog" class="btn-5">Visit Our Blogs <i class="fa fa-angle-double-right"></i></a>
    </div>
  </div> --}}
  <!-- Blog end -->

  <!--  -->
  <div class="action-bar container d-md-none">
    <a href="tel:+233201492986">
      <div class="call-action action-group">
        <span class="fa fa-phone-alt"></span>
        <p>CALL</p>
      </div>
    </a>
    <a href="https://wa.me/233201492986">
      <div class="whatsapp-action action-group">
        <span class="fab fa-whatsapp"></span>
        <p>WHATSAPP</p>
      </div>
    </a>
    <a href="mailto:info@lowoap.com">
      <div class="sms-action action-group">
        <span class="fas fa-envelope"></span>
        <p>EMAIL</p>
      </div>
    </a>

  </div>
  <!--  -->
@endsection
