@extends("layouts.app")

@push("header")
  <style>
    .half-star {
      position: relative;
      display: inline-block;
    }

    .half-star .fa-star,
    .half-star .fa-star-o {
      position: absolute;
      top: 0;
      left: 0;
    }

    .half-star .fa-star-half {
      width: 50%;
      overflow: hidden;
      white-space: nowrap;
    }
  </style>
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
              <div class="pull-left d-flex" style="align-items: center;">
                <h2 style="margin: auto;">{{ ucwords($singleProp->title) }} </h2>
                @if ($singleProp->offer_type != "sale")
                  <div class="ratings-2 mx-2">
                    <span>{{ $singleProp->offer_type }}</span>
                  </div>
                @endif
              </div>
              <div class="pull-right">
                <h2>
                  <span>
                    {{ $singleProp->currency }} @if ($singleProp->category == "hostel")
                      {{ $singleProp->price_range }}
                    @else
                      {{ $singleProp->price }}
                    @endif
                  </span>
                  @if ($singleProp->offer_type != "sale")
                    <span>/{{ $singleProp->period }}</span>
                  @endif
                </h2>
              </div>
            </div>
            <div class="clearfix">
              <div class="pull-left">
                <ul>
                  <li><i class="flaticon-bed"></i> Bedroom {{ $singleProp->bed }}</li>
                  <li><i class="flaticon-bathroom"></i> Washroom {{ $singleProp->bath }}</li>
                  <li><i class="flaticon-area"></i> SQ.FT {{ $singleProp->sqm }}</li>
                </ul>
              </div>

              <div class="pull-right">
                <div class="ratings-2">
                  @if ($singleProp->offer_type != "sale")

                    @php
                      $ratingAvg = $singleProp->ratings->avg("rating_val");
                      $fullStars = intval($ratingAvg);
                      $halfStar = $ratingAvg - $fullStars >= 0.5 ? true : false;
                      $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                    @endphp

                    @if ($singleProp->ratings->count() >= 1)
                      @for ($i = 0; $i < $fullStars; $i++)
                        <i class="fa fa-star"></i>
                      @endfor

                      @if ($halfStar)
                        <i class="fa half-star fa-star-half"></i>
                      @endif

                      @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="fa fa-star-o"></i>
                      @endfor
                      <span>( {{ $ratingAvg }}/5 )</span>
                    @endif
                  @else
                    <span>{{ $singleProp->offer_type }}</span>
                  @endif
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <!-- Properties description start -->
          <div class="product-slider-box bg-white">
            <div class="product-img-slide">
              <div class="slider-for">
                @foreach ($singleProp->images as $image)
                  <img loading="lazy" src="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                    class="img-fluid w-100" alt="{{ $singleProp->title }}">
                @endforeach
              </div>
              <div class="slider-nav">
                @foreach ($singleProp->images as $image)
                  <div class="thumb-slide"><img loading="lazy"
                      src="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                      alt="{{ $singleProp->title . "preview" }}"></div>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Properties description start -->
          <div class="py-3 bg-white container">
            <!-- Properties description start -->
            <div class="properties-description">

              <h3 class="heading">
                About This Listing
              </h3>
              <h5>
                <button class="btn-6">Property ID: {{ $singleProp->id }}</button>

              </h5>

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
              <div class="row filter-portfolio">
                @foreach ($singleProp->images as $image)
                  <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="portfolio-item">
                      <a href="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                        title="{{ $singleProp->title }}">
                        <img loading="lazy" src="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                          alt="{{ $singleProp->title }}" class="img-fluid">
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
            <!-- Photo gallery end -->

            <!-- Leave a Comment -->
            {{-- @if ($singleProp->offer_type != "sale")
              @auth
                <div class="contact-2 ca mtb-50 bg-white container">
                  <h3 class="heading-2">Leave a Comment</h3>
                  <form action="{{ route("comments.store") }}" method="POST" id="comment_form">
                    @csrf
                    <div class="row">
                      <div class="d-none">
                        <input type="hidden" name="prop_id" value="{{ $singleProp->id }}">
                        <input type="number" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <textarea class="form-control" name="comment" placeholder="Write comment" aria-label="Write message" maxlength="3000"></textarea>
                          @error("comment")
                            <p class="text-danger pull-left mb-4">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="send-btn">
                          <button type="submit" class="btn-6">Submit</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              @endauth

              <div class="contact-2 ca mtb-20 container">
                <h3 class="heading-2">Comments Section
                </h3>
                @guest
                  <h6>
                    <a href="login" class="read-more">Signin to leave a comment</a>
                  </h6>
                @endguest

                <ul id="commentsList" class="comments mt-5">
                  @include("partials.comments", ["comments" => $comments, "singleProp" => $singleProp])
                </ul>

                @if ($comments->hasMorePages())
                  <a href="javascript::void(0)" id="loadMoreComments" data-page="2"
                    data-property-id="{{ $singleProp->id }}">See More
                    Comments <i class="fas fa-chevron-down"></i></a>
                @endif

              </div>
            @endif --}}

            <!-- Contact 2 start -->
            <div class="contact-2 ca mtb-50 container">
              <h3 class="heading">Interested in this Property?</h3>
              <form class="needs-validation" novalidate method="POST"
                action="{{ route("insert.request", $singleProp->id) }}" id="request_callback_form">
                @csrf
                <div class="row">
                  <div class="d-none">
                    <input type="number" id="prop_id" name="prop_id" value="{{ $singleProp->id }}">
                    <input type="number" id="user_id" name="user_id"
                      value="{{ auth()->check() ? Auth::user()->id : null }}">
                  </div>
                  <div class="col-md-6">
                    <div class="form-group name has-validation">
                      <input required type="text" name="name"
                        value="{{ auth()->check() ? auth()->user()->name : "" }}" class="form-control text-capitalize"
                        placeholder="Name" aria-label="Full Name">
                      <div class="invalid-feedback">
                        Please provide your name.
                      </div>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group email has-validation">
                      <input required type="email" name="email"
                        value="{{ auth()->check() ? auth()->user()->email : "" }}" class="form-control"
                        placeholder="Email Address" aria-label="Email Address">

                      <div class="invalid-feedback">
                        Please provide a valid email.
                      </div>
                      {{-- @error("email")
                        <p class="text-danger pull-left mb-4">{{ $message }}</p>
                      @enderror --}}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group number has-validation">
                      <input required type="text" name="phone" class="form-control" placeholder="Phone"
                        value="{{ auth()->check() ? auth()->user()->phone : "" }}">
                      <div class="invalid-feedback">
                        Please provide a phone number.
                      </div>
                      {{-- @error("phone")
                        <p class="text-danger pull-left mb-4">{{ $message }}</p>
                      @enderror --}}

                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group message">
                      <textarea class="form-control" name="message" placeholder="Write message" aria-label="Write message"
                        maxlength="9000"></textarea>
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
          </div>

          <br>
          <br>

          <!--Related Property -->
          @if ($relatedProps->count() > 0)
            <div class="similar-property mb-20">
              <h3 class="heading-2">Similar Properties</h3>
              <div class="">
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

                </div>

              </div>
            </div>
          @endif
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
                      <i class="fab fa-whatsapp"> </i><a href="https://wa.me/233201492986">
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
                      <i class="fab fa-whatsapp"> </i><a href="#"> +233 20 149 2986</a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>

          <!-- Rate Property -->
          <div class="sidebar-right rounded">
            <div class="widget-3">
              <h3 class="sidebar-title">Rate this Property</h3>
              <div class="s-border"></div>
              <div class="s-border"></div>

              <div class="text text-start">
                <div class="ratings-2 text-warning">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                  <span>( {{ $singleProp->ratings->count() }} Reviews )</span>
                </div>
              </div>
              <div class="social-media clearfix">
                <div data-coreui-toggle="rating" data-coreui-tooltips="Very bad, Bad, Meh, Good, Very good"
                  data-coreui-value="3" id="myRatingCustomIcons1"></div>
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
                    href="https://www.facebook.com/sharer/sharer.php?u={{ route("single.prop", $singleProp->slug) }}&quote={{ $singleProp->title }}">
                    <div class="icon facebook">
                      <div class="tooltip">Facebook</div>
                      <span><i class="fab fa-facebook"></i></span>
                    </div>
                  </a>
                  <a target="blank"
                    href="https://twitter.com/intent/tweet?text={{ $singleProp->title }}&url={{ route("single.prop", $singleProp->slug) }}">
                    <div class="icon twitter">
                      <div class="tooltip">Twitter</div>
                      <span><i class="fab fa-twitter"></i></span>
                    </div>
                  </a>

                  <a target="blank"
                    href="https://www.linkedin.com/sharing/share-offsite/?url={{ route("single.prop", $singleProp->slug) }}">
                    <div class="icon linkedin mr-0">
                      <div class="tooltip">LinkedIn</div>
                      <span><i class="fab fa-linkedin"></i></span>
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
    (function() {
      'use strict';

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation');
      // Loop over them and prevent submission if there are invalid fields
      Array.prototype.slice.call(forms)
        .forEach(function(form) {
          form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
              form.classList.add('was-validated');
            } else {
              event.preventDefault(); // Prevent the default form submission behavior

              // Serialize the form data
              var formData = $(form).serialize();

              // Include CSRF token for Laravel
              var csrfToken = $('meta[name="csrf-token"]').attr('content');

              // Submit the form via AJAX
              $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                headers: {
                  'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                  // Handle successful response
                  if (response.error) {
                    showToast(response.message, 'bg-danger');
                  } else {
                    // Reset the form
                    form.reset();
                    form.classList.remove('was-validated');
                    showToast(response.message, 'bg-success');
                  }
                },
                error: function(xhr, status, error) {
                  // Handle error response
                  console.error('Error:', xhr.responseText);
                  showToast('Error: Something went wrong.', 'bg-danger');
                }
              });
            }
          }, false);
        });
    });



    $('#comment_form').on('submit', function(event) {
      event.preventDefault();

      let form = this;

      $.ajax({
        url: "{{ route("comments.store") }}",
        method: "POST",
        data: $(form).serialize(),
        success: function(response) {
          // Handle successful response
          if (response.error) {
            showToast(response.message, 'bg-danger');
          } else {
            // Reset the form
            form.reset();
            showToast(response.message, 'bg-success');
          }
        },
        error: function(xhr, status, error) {
          // Handle error response
          console.error('Error:', xhr.responseText);
          showToast('Error: Something went wrong.', 'bg-danger');
        }
      });
    });

    // Reply function
    function reply(caller) {
      // Get the data-parent-id value from the caller
      var parentId = $(caller).data('parent-id');

      // Find the parent comment element of the clicked reply button
      var parentComment = $(caller).closest('.comment');

      // Find the repliesDiv within the parent comment
      var repliesDiv = parentComment.find('.repliesDiv');

      // Set the parent_id input field value
      repliesDiv.find('input[name="parent_id"]').val(parentId);

      // Toggle the display of the repliesDiv
      repliesDiv.toggle();
    }

    $('#replyForm').on('submit', function(event) {
      event.preventDefault();

      let form = this;

      $.ajax({
        url: "{{ route("reply.store") }}",
        method: "POST",
        data: $(form).serialize(),
        success: function(response) {
          // Handle successful response
          if (response.error) {
            showToast(response.message, 'bg-danger');
          } else {
            // Reset the form
            form.reset();
            showToast(response.message, 'bg-success');
          }
        },
        error: function(xhr, status, error) {
          // Handle error response
          console.error('Error:', xhr.responseText);
          showToast('Error: Something went wrong.', 'bg-danger');
        }
      });
    });

    function showToast(message, bgClass) {
      // Remove hidden class
      $('#toast-div').removeClass('d-none');

      // Update the toast body content
      $('#liveToast .toast-body').text(message);

      // Update the background class
      $('#liveToast').removeClass('bg-success bg-danger').addClass(bgClass);

      // Show the toast
      var toast = new bootstrap.Toast(document.getElementById('liveToast'));
      toast.show();
    }
  </script>
  <script>
    document.getElementById('loadMoreComments').addEventListener('click', function() {
      var button = this;
      var page = button.getAttribute('data-page');
      var propertyId = button.getAttribute('data-property-id');

      fetch(`/property/${propertyId}/comments/${page}`)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error loading comments:', data.error);
            return;
          }

          document.getElementById('commentsList').insertAdjacentHTML('beforeend', data.comments);

          // Update the data-page attribute for the next set of comments
          var nextPage = parseInt(page) + 1;
          button.setAttribute('data-page', nextPage);

          // Hide the button if there are no more comments to load
          if (!data.hasMorePages) {
            button.style.display = 'none';
          }
        })
        .catch(error => console.error('Error loading comments:', error));
    });
  </script>
@endpush
