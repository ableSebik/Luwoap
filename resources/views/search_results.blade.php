@extends("layouts.app")

@section("content")
  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>
          Search Results
        </h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">
            Search Results
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->

  {{-- Property listings --}}
  <div class="property-section content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title">
        <h1>Showing results for:</h1>
        <p><em>{{ $query }}</em></p>
      </div>
      <hr>
      @if (!empty($propertyResults))
        <div class="row">
          <div class="offset-lg-1 col-lg-10">
            <div class="properties-section-body content-area">
              <div class="container">
                <div class="row">
                  <div class="offset-lg-1 col-lg-10">
                    @foreach ($propertyResults as $property)
                      <!-- Property box 2 start -->
                      <div class="property-box-2">
                        <div class="row g-0">
                          <div class="col-lg-4 col-md-5">
                            <div class="property-photo">
                              <a href="properties-details.html" class="property-img">
                                <img src="{{ asset("storage/uploads/ft_images/" . $property->ft_image) }}"
                                  alt="big-properties" class="img-fluid">
                                <div class="tag">{{ $property->offer_type }}</div>
                                <div class="price-box">
                                  <span>{{ $property->currency }}{{ $property->price }}</span>
                                  @if ($property->offer_type == "rent" || $property->offer_type == "lease")
                                    Per month
                                  @endif
                                </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-lg-8 col-md-7">
                            <div class="detail">
                              <div class="hdg">
                                <h3 class="title">
                                  <a href="{{ route("single.prop", $property->id) }}">{{ $property->title }}</a>
                                </h3>
                                <h5 class="location">
                                  <a href="{{ route("single.prop", $property->id) }}">
                                    <i class="flaticon-pin"></i>{{ $property->location }}
                                  </a>
                                </h5>
                              </div>
                              <ul class="facilities-list clearfix">
                                <li>
                                  <span>Beds</span> {{ $property->bed }}
                                </li>
                                <li>
                                  <span>Baths</span> {{ $property->bath }}
                                </li>
                                <li>
                                  <span>Area</span>{{ $property->sq_ft }} Sqft
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <!-- Properties box 2 end -->
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif

      @if (!empty($blogResults))
        @foreach ($blogResults as $blogResult)
          <div class="blog-2">
            <div class="detail">
              <h3 class="title">
                <a href="{{ route("postDetails.blog", $blogResult->id) }}">{{ $blogResult->post_title }}</a>
              </h3>
              <p>{{ $blogResult->post_excerpt }}</p>
            </div>
          </div>
          <hr>
        @endforeach
      @endif

      @if (empty($blogResults) && empty($propertyResults))
        <h5>No results found.</h5>
      @endif
    </div>
  </div>
@endsection
