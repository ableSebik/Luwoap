@extends("layouts.app")

@section("content")
  <!-- Banner start -->
  <div class="banner" id="banner">
    <div id="bannerCarousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item banner-max-height active item-bg">
          <div id="boxgallery" class="boxgallery" data-effect="effect-3">
            <div class="panel"><img src="{{ asset("assets/img/banner/img-2.jpg") }}" alt="Image 1" /></div>
            <div class="panel"><img src="{{ asset("assets/img/banner/img-3.jpg") }}" alt="Image 1" /></div>
            <div class="panel"><img src="{{ asset("assets/img/banner/img-1.jpg") }}" alt="Image 1" /></div>
            <div class="panel"><img src="{{ asset("assets/img/banner/img-5.jpg") }}" alt="Image 1" /></div>
          </div>
        </div>
        <div class="carousel-caption d-flex h-100">
          <div class="carousel-content container">
            <div class="text-center bi-3">
              <div class="clearfix">
                <h3>Find Your Dream Home</h3>
                <p>Ghana's No.1 Real Estate Portal</p>
              </div>
              <div class="clearfix"></div>
              {{-- search bar --}}
              <form action="{{ route("search") }}" method="get">
                <div class="inline-search-area isa-5 isa-992 clearfix">

                  <div class="row">
                    <div class="col-md-9 col-lg-9 col-sm-12">
                      <input class="form-control search-fields sf" name="query" placeholder="What are you looking for?">
                    </div>

                    <div class="col-md-3 col-lg-3 col-sm-12">
                      <button class="btn button-theme btn-search w-100 mb-0">
                        <strong>Search</strong>
                      </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner end -->

  {{-- Property listings --}}
  <div class="property-section content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title">
        <h1>Latest Properties</h1>
        <p>BROWSE HOT OFFERS</p>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <div class="row">
            @foreach ($props as $prop)
              <div class="col-lg-4 col-md-6 col-sm-12">
                <x-property-box :prop="$prop" />
              </div>
            @endforeach
          </div>
          <a href="/all-properties" class="btn-4 none-btn-992">More Properties <i
              class="fa fa-angle-double-right"></i></a>
        </div>
      </div>
    </div>
  </div>
  {{-- End Property listings --}}

  <!-- Services start -->
  <div class="services services-2 content-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 align-self-center">
          <!-- Main title -->
          <div class="main-title-5 main-title-7">
            <h1>Why Choose <span>Us</span></h1>
            <div class="title-border mb-4">
              <div class="title-border-inner"></div>
              <div class="title-border-inner"></div>
              <div class="title-border-inner"></div>
            </div>
            <a href="services.html" class="btn-4 none-btn-992">Read More <i class="fa fa-angle-double-right"></i></a>
          </div>
        </div>
        <div class="col-lg-7 offset-lg-1">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="single-info-2">
                <div class="number">1</div>
                <div class="icon">
                  <div class="icon-inner">
                    <i class="flaticon-apartment"></i>
                  </div>
                </div>
                <h2>
                  <a href="services.html">Apartments</a>
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="single-info-2">
                <div class="number">2</div>
                <div class="icon">
                  <div class="icon-inner">
                    <i class="flaticon-empire-state-building"></i>
                  </div>
                </div>
                <h2>
                  <a href="services.html">Houses</a>
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="single-info-2">
                <div class="number">3</div>
                <div class="icon">
                  <div class="icon-inner">
                    <i class="flaticon-car"></i>
                  </div>
                </div>
                <h2>
                  <a href="services.html">Garages</a>
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
              <div class="single-info-2">
                <div class="number">4</div>
                <div class="icon">
                  <div class="icon-inner">
                    <i class="flaticon-trust"></i>
                  </div>
                </div>
                <h2>
                  <a href="services.html">Buyers Trust Us</a>
                </h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Services end -->

  <!-- Blog start -->
  <div class="blog comon-slick content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title-3">
        <p>Our Blog</p>
        <h1>Latest <span>News</span></h1>
      </div>
      <div class="row">
        @foreach ($recentPostsData["blogPosts"] as $recentBlogPost)
          <div class="col-lg-4 col-md-4">
            <div class="blog-2">
              <div class="blog-image">
                <img src="{{ asset("storage/Post/" . $recentBlogPost->post_ft_image) }}"
                  alt="{{ $recentBlogPost->post_title }}" class="img-fluid bp">
                <div class="date-box">
                  <span>{{ $recentPostsData["post_day"] }}</span>{{ $recentPostsData["post_month"] }}
                </div>

              </div>
              <div class="detail">
                <h4>
                  <a href="{{ route("postDetails.blog", $recentBlogPost->id) }}">{{ $recentBlogPost->post_title }}</a>
                </h4>
                <p>{{ $recentBlogPost->post_excerpt }}</p>
                <a href="{{ route("postDetails.blog", $recentBlogPost->id) }}" class="read-more">Read more</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <a href="/blog" class="btn-4 none-btn-992">More Blogs <i class="fa fa-angle-double-right"></i></a>
    </div>
  </div>
  <!-- Blog end -->
@endsection
