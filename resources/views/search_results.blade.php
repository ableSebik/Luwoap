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
        <br>
        <form action="{{ route("search") }}" method="get">
          @csrf
          <div class="inline-search-area isa-5 isa-992 clearfix">

            <div class="row">
              <div class="col-md-9 col-lg-9 col-sm-12">
                <input required class="form-control search-fields sf" name="query"
                  placeholder="What are you looking for?">
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
  <!-- Sub Banner end -->

  {{-- Property listings --}}
  <div class="properties-section-body content-area">
    <div class="container">
      <div class="mb-5 bg-white p-3">
        <h2>Showing results for:</h2>
        <h4><em>{{ $query }}</em></h4>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-6 col-sm-12">
          <div class="row">
            <!-- Property search results -->
            @if (!$propertyResults->isEmpty())
              <div class="col-lg-12 col-md-12 col-sm-12">
                @foreach ($propertyResults as $property)
                  <!-- Property box 2 start -->
                  <div class="property-box-2">
                    <div class="row g-0">
                      <div class="col-lg-4 col-md-5">
                        <div class="property-photo">
                          <a href="{{ route("single.prop", $property->id) }}" class="property-img">
                            <img src="{{ asset("storage/uploads/ft_images/" . $property->ft_image) }}"
                              alt="{{ $property->title }}" class="img-fluid">
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
                              <span>Area</span>{{ $property->sqm }} sqm
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

              <!-- Blog search results -->
            @elseif (!$blogResults->isEmpty())
              <div class="col-lg-12 col-md-12 col-sm-12">
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
              </div>
            @endif
            {{-- {{ dd($propertyResults) }} --}}
            @if ($propertyResults->isEmpty() && $blogResults->isEmpty())
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-danger">No results found</div>
              </div>
            @endif

          </div>
        </div>

        <!-- sidebar-->
        <div class="col-lg-4 col-md-12">
          <div class="sidebar-right rounded">
            <!-- Advanced search start -->
            <x-advanced-search />
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
