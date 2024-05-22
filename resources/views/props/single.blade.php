@extends("layouts.app")

@push("header")
  <script src="https://cdn.tiny.cloud/1/yrqv9l2ukvxz17q6fnqs5bgfm1vzbtogf8s8e5yrwaqpwy29/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
@endpush

@section("content")

  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>Property Details</h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">Property Detail</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->

  <!-- Property details page start -->
  <div class="property-details-page content-area-6">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
          <div class="heading-properties-2 mb-40">
            <div class="clearfix">
              <div class="pull-left">
                <h1>{{ $singleProp->title }}</h1>
              </div>
              <div class="pull-right">
                <h1><span>{{ $singleProp->currency }} {{ $singleProp->price }}</span></h1>
              </div>
            </div>
            <div class="clearfix">
              <div class="pull-left">
                <ul>
                  <li><i class="flaticon-bed"></i> Bedroom {{ $singleProp->bed }}</li>
                  <li><i class="flaticon-bathroom"></i> Bath {{ $singleProp->bath }}</li>
                  <li><i class="flaticon-area"></i> SQ.FT {{ $singleProp->sqm }}</li>
                  {{-- <li><i class="flaticon-car"></i> Garage 1</li>
                  <li><i class="flaticon-window"></i> Balcony 1</li> --}}
                </ul>
              </div>
              <div class="pull-right">
                <div class="ratings-2">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <span>( 4.5/5 )</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12">
          <!-- Properties desciption start -->
          <div class="product-slider-box cds-2 clearfix mb-40">
            <div class="product-img-slide">
              <div class="slider-for">
                @foreach ($singleProp->images as $image)
                  <img src="{{ asset("storage/uploads/$image->prop_id/" . $image->image) }}" class="img-fluid w-100"
                    alt="slider-photo">
                @endforeach
              </div>
              <div class="slider-nav">
                @foreach ($singleProp->images as $image)
                  <div class="thumb-slide"><img src="{{ asset("storage/uploads/$image->prop_id/" . $image->image) }}"
                      alt="small-photo"></div>
                @endforeach
              </div>
            </div>
          </div>
          <!-- Properties description start -->

          <!-- Properties description start -->
          <div class="properties-description mb-40">
            <p><strong><mark> Property ID: {{ $singleProp->id }}</mark></strong></p>
            <h3 class="heading-2">
              Description
            </h3>

            <p> {!! $singleProp->more_info !!}</p>
          </div>
          <!-- End Property description start -->

          <!-- Amenities start -->
          @unless (strlen($singleProp->amenities) < 1)
            <div class="properties-amenities mb-40">
              <h3 class="heading-2">
                Amenities
              </h3>
              <div class="row">
                @foreach (explode(",", $singleProp->amenities) as $amenity)
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <ul class="amenities">
                      <li>
                        <i class="fa fa-check"></i>{{ strtoupper($amenity) }}
                      </li>
                    </ul>
                  </div>
                @endforeach

              </div>
            </div>
          @endunless

          <!-- Photo gallery start -->
          <div class="video mb-50">
            <h3 class="heading-2">Gallery</h3>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p> --}}
            <div class="row filter-portfolio">
              @foreach ($singleProp->images as $image)
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <div class="portfolio-item">
                    <a href="{{ asset("storage/uploads/$image->prop_id/" . $image->image) }}"
                      title="{{ $singleProp->title }}">
                      <img src="{{ asset("storage/uploads/$image->prop_id/" . $image->image) }}" alt="gallery-photo"
                        class="img-fluid">
                    </a>
                    <div class="portfolio-content">
                      <div class="portfolio-content-inner">
                        <span><i class="fa fa-search"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <!-- Contact 2 start -->
          <div class="contact-2 ca mtb-50">
            <h3 class="heading">Interested in this Property?</h3>
            <form method="POST" action="{{ route("insert.request", $singleProp->id) }}" id="request_callback_form">
              @csrf
              <div class="row">
                <div class="d-none">
                  <input type="number" id="prop_id" name="prop_id" value="{{ $singleProp->id }}">
                  <input type="number" id="user_id" name="user_id"
                    value="{{ auth()->check() ? Auth::user()->id : null }}">
                </div>
                <div class="col-md-6">
                  <div class="form-group name">
                    <input type="text" name="name" value="{{ auth()->check() ? auth()->user()->name : "" }}"
                      class="form-control" placeholder="Name" aria-label="Full Name">
                    @error("name")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group email">
                    <input type="email" name="email" value="{{ auth()->check() ? auth()->user()->email : "" }}"
                      class="form-control" placeholder="Email Address" aria-label="Email Address">
                    @error("email")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group number">
                    <input type="text" name="phone" class="form-control" placeholder="Phone"
                      value="{{ auth()->check() ? auth()->user()->phone : "" }}">
                    @error("phone")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror

                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group message">
                    <textarea class="form-control" name="message" placeholder="Write message" aria-label="Write message"></textarea>
                    @error("message")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="send-btn">
                    <button type="submit" class="btn-6">Send Message</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- Photo gallery end -->
          <br>
          {{-- <div class="location mb-50">
            <div class="map">
              <h3 class="heading-2">Property Location</h3>
              <div id="map" class="contact-map"></div>
            </div>
          </div> --}}

          <!-- Video start -->
          {{-- <div class="video mb-50">
            <h3 class="heading-2">
              Property Video
            </h3>
            <iframe src="https://www.youtube.com/embed/5e0LxrLSzok" allowfullscreen=""></iframe>
          </div> --}}
          <br>
          <!--Related Property -->
          <div class="similar-property mb-20 bg-gray">
            <h3 class="heading-2">Similar Properties</h3>
            <div class="container">
              @if ($relatedProps->count() > 0)
                <div class="slick-slider-area">
                  <div class="row slick-carousel"
                    data-slick='{"slidesToShow": 2, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}}]}'>
                    {{-- property box component --}}
                    @foreach ($relatedProps as $relatedProp)
                      <div class="slick-slide-item">
                        <x-property-box :prop="$relatedProp" />
                      </div>
                    @endforeach
                  </div>
                  <div class="slick-prev slick-arrow-buton">
                    <i class="fa fa-angle-left"></i>
                  </div>
                  <div class="slick-next slick-arrow-buton">
                    <i class="fa fa-angle-right"></i>
                  </div>
                </div>
              @else
                <h5>No related properties.</h5>
              @endif
            </div>
          </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4 col-md-12">
          <div class="sidebar-right rounded">
            <!-- Agent start -->
            <div class="agent-3 widget">
              <h3 class="sidebar-title">Contact Admin</h3>
              <div class="s-border"></div>
              <div class="m-border"></div>
              <div class="media mb-4">
                {{-- <a class="pr-3" href="agent-detail.html">
                  <img src="{{ asset("assets/img/avatar/avatar-1.jpg") }}" alt="agent-3" class="img-fluid">
                </a> --}}
                <div class="media-body align-self-center">
                  <h5>
                    @if ($singleProp->user)
                      Name: {{ strtoupper($singleProp->user->name) }}
                    @else
                      Name: Jedidiah Apenteng
                    @endif
                  </h5>
                </div>
              </div>
              <div class="contact">
                <ul>
                  @if ($singleProp->user)
                    <li>
                      <i class="fa fa-envelope"> </i><a href="mailto:{{ $singleProp->user->email }}">
                        {{ $singleProp->user->email }} </a>
                    </li>
                    <li>
                      <i class="fa fa-phone"></i> <a href="tel:{{ $singleProp->user->phone }}">
                        {{ $singleProp->user->phone }}</a>
                    </li>
                    <li>
                      <i class="fa fa-whatsapp"> </i><a href="https://wa.me/233201492986">
                        {{ $singleProp->user->phone }}</a>
                    </li>
                  @else
                    <li>
                      <i class="fa fa-envelope"> </i><a href="mailto:info@luwoap.com"> info@luwoap.com </a>
                    </li>
                    <li>
                      <i class="fa fa-phone"> </i><a href="tel:233201492986">
                        +233 20 149 2986</a>
                    </li>
                    <li>
                      <i class="fa fa-whatsapp"> </i><a href="#"> +233 20 149 2986</a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
          <div class="sidebar-right rounded">
            <!-- Advanced search start -->
            <x-advanced-search />
          </div>
          <div class="sidebar-right rounded">
            <!-- Social media share -->
            <div class="widget-3 advanced-search">
              <h3 class="sidebar-title">Share</h3>
              <div class="s-border"></div>
              <div class="m-border"></div>

              <div class="social-media clearfix">
                <div class="social-list">
                  <a target="blank"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ route("single.prop", $singleProp->id) }}&quote={{ $singleProp->title }}">
                    <div class="icon facebook">
                      <div class="tooltip">Facebook</div>
                      <span><i class="fa fa-facebook"></i></span>
                    </div>
                  </a>
                  <a target="blank"
                    href="https://twitter.com/intent/tweet?text={{ $singleProp->title }}&url={{ route("single.prop", $singleProp->id) }}">
                    <div class="icon twitter">
                      <div class="tooltip">Twitter</div>
                      <span><i class="fa fa-twitter"></i></span>
                    </div>
                  </a>

                  <a target="blank"
                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ route("single.prop", $singleProp->id) }}">
                    <div class="icon linkedin mr-0">
                      <div class="tooltip">LinkedIn</div>
                      <span><i class="fa fa-linkedin"></i></span>
                    </div>
                  </a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Property details page end -->

  <!-- Toast -->
  <div class="position-fixed p-3 d-none" id="toast-div" style="bottom: 15%; right: 0; z-index: 999999">
    <div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true"
      id="liveToast">
      <div class="d-flex">
        <div class="toast-body">
          <!-- This will be dynamically filled by the JavaScript -->
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
          aria-label="Close"></button>
      </div>
    </div>
  </div>
  <!-- end Toast -->
@endsection

@push("scripts")
  <script>
    $(document).ready(function() {
      $('#request_callback_form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Serialize the form data
        var formData = $(this).serialize();

        // Submit the form via AJAX
        $.ajax({
          url: $(this).attr('action'),
          type: 'POST',
          data: formData,
          success: function(response) {
            // Handle successful response
            if (response.error) {
              showToast('Request already submitted for this property.', 'bg-danger');
            } else {
              // Reset the form
              $('#request_callback_form')[0].reset();
              showToast('Success: Request submitted successfully.', 'bg-success');
            }
          },
          error: function(xhr, status, error) {
            // Handle error response
            showToast('Error: Something went wrong.', 'bg-danger');
          }
        });
      });

      function showToast(message, bgClass) {
        //remove hidden class
        $('#toast-div').removeClass('d-none');

        // Update the toast body content
        $('#liveToast .toast-body').text(message);

        // Update the background class
        $('#liveToast').removeClass('bg-success bg-danger').addClass(bgClass);

        // Show the toast
        var toast = new bootstrap.Toast(document.getElementById('liveToast'));
        toast.show();
      }
    });
  </script>

  <script>
    tinymce.init({
      selector: 'textarea',
    });
  </script>
@endpush
