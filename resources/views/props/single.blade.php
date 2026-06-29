@extends("layouts.app")

@section("content")

  <div class="property-details-page content-area-6">
    <div class="container">
      <!--Top bar (title and price detials) -->
      <div class="row">
        <div class="col-lg-12">
          <div class="heading-properties-2 mb-40">
            <div class="clearfix">
              <div class="pull-left">
                <h1>{{ ucwords($singleProp->title) }}</h1>
              </div>
              <div class="pull-right">
                <h1>
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
                </h1>
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
                  <span>{{ ucwords($singleProp->offer_type) }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--This row is the Property Detials + Sidebar Row-->
      <div class="row mb-40">
        <div class="col-lg-8 col-md-12 mb-40">
          <!-- Properties slider start -->
          <div class="product-slider-box cds-2 clearfix mb-40">
            <div class="product-img-slide">
              <div class="slider-for">
                @foreach ($singleProp->images as $image)
                  <img loading="lazy" src="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                    class="img-fluid w-100" alt="{{ $singleProp->title }}">
                @endforeach
              </div>

              <div class="slider-nav bg-white">
                @foreach ($singleProp->images as $image)
                  <div class="thumb-slide">
                    <img loading="lazy" src="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                      alt="{{ $singleProp->title . "preview" }}">
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <!-- Properties slider end -->

          <!-- Properties description start -->
          <div class="py-3 bg-white container">
            <!-- Properties description start -->
            <div class="properties-description">
              <h3 class="heading">About This Listing</h3>
              <h5><button class="btn-6">Property ID: {{ $singleProp->id }}</button></h5>
              <p> {!! $singleProp->more_info !!}</p>
            </div>
            <!-- End Property description start -->

            <!-- Amenities start -->
            @unless (strlen($singleProp->amenities) < 1)
              <div class="properties-amenities mb-40">
                <h3 class="heading-2">Amenities</h3>
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
            <!-- Amenities end -->

            <!-- Photo gallery start -->
            {{-- <div class="video mb-50">
              <h3 class="heading-2">Gallery</h3>
              <div class="row filter-portfolio">
                @foreach ($singleProp->images as $image)
                  <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="portfolio-item">
                      <a href="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                        title="{{ $singleProp->title }}">
                        <img loading="lazy" src="{{ Storage::url("uploads/$image->prop_id/" . $image->image) }}"
                          alt="{{ $singleProp->title }}" class="img-fluid">
                      </a>

                    </div>
                  </div>
                @endforeach
              </div>
            </div> --}}
            <!-- Photo gallery end -->

            <!-- Leave a Comment -->
            @if ($singleProp->category == "hostel")
              <div class="contact-2 ca">
                <h3 class="heading-2">Comments</h3>
                @guest
                  <h6>
                    @if (!$comments->count())
                      0 comment
                    @endif
                    <a href="{{ route("login", ["redirect" => url()->current()]) }}" class="read-more">--Signin to add
                      comment</a>
                  </h6>
                @endguest
                @if ($comments->count())
                  <div class="commentList container">
                    <ul id="commentsList" class="comments mt-2">
                      @include("partials.comments", ["comments" => $comments, "singleProp" => $singleProp])
                    </ul>

                    @if ($comments->hasMorePages())
                      <a href="javascript::void(0)" id="loadMoreComments" data-page="2"
                        data-property-id="{{ $singleProp->id }}">See More
                        Comments <i class="fas fa-chevron-down"></i></a>
                    @endif
                  </div>
                @endif
              </div>

              @auth
                <div class="comment-section">
                  <form class="form-inline d-flex" action="{{ route("comments.store") }}" method="POST" id="comment_form">
                    @csrf
                    <div class="d-none">
                      <input type="hidden" name="prop_id" value="{{ $singleProp->id }}">
                      <input type="number" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <input class="form-control" type="comment" name="comment" id="comment" placeholder="add comment..."
                      required>
                    <button type="submit" class="btn">Submit</button>
                  </form>
                </div>
              @endauth
            @endif
            <!-- Leave a Comment end -->
          </div>
          <!-- Properties description end -->

          <!-- Contact 2 start -->
          <div class="contact-2 ca mtb-50 container">
            <h3 class="heading">Interested in this Property?</h3>
            <form class="form" method="POST" action="{{ route("insert.request", $singleProp->id) }}"
              id="request_callback_form">
              @csrf
              <div class="row">
                <div class="d-none">
                  <input type="number" id="prop_id" name="prop_id" value="{{ $singleProp->id }}">
                  <input type="number" id="user_id" name="user_id"
                    value="{{ auth()->check() ? Auth::user()->id : null }}">
                </div>
                <div class="col-md-6">
                  <div class="form-group name ">
                    <input required type="text" name="name"
                      value="{{ auth()->check() ? auth()->user()->name : "" }}" class="form-control text-capitalize"
                      placeholder="Name" aria-label="Full Name">
                    @error("email")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group email ">
                    <input required type="email" name="email"
                      value="{{ auth()->check() ? auth()->user()->email : "" }}" class="form-control"
                      placeholder="Email Address" aria-label="Email Address">
                    @error("email")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group number ">
                    <input required type="text" name="phone" class="form-control" placeholder="Phone"
                      value="{{ auth()->check() ? auth()->user()->phone : "" }}">
                    @error("phone")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror

                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group message">
                    <textarea class="form-control" name="message" required placeholder="Write message" aria-label="Write message"
                      maxlength="9000"></textarea>
                    @error("message")
                      <p class="text-danger pull-left mb-4">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="send-btn">
                    <button type="submit" class="btn-5">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4 col-md-12">
          <div class="sidebar-right rounded">
            <!-- Agent start -->
            <div class="agent-3 widget">
              <h3 class="sidebar-title">Contact</h3>
              <div class="s-border"></div>
              <div class="m-border"></div>
              <div class="media mb-4">

                <div class="media-body align-self-center">
                  <p>
                    @if ($singleProp->user)
                      Name: {{ ucwords($singleProp->user->name) }}
                    @else
                      Name: Jedidiah Apenteng
                    @endif
                  </p>
                </div>
              </div>
              <div class="contact">
                <ul>
                  @if ($singleProp->user)
                    <li>
                      <i class="far fa-envelope"> Email: </i> <a class="pull-right"
                        href="mailto:{{ $singleProp->user->email }}">
                        {{ $singleProp->user->email }} </a>
                    </li>
                    <li>
                      <i class="fa fa-phone"> Phone:</i><a class="pull-right"
                        href="tel:{{ $singleProp->user->phone }}">
                        {{ $singleProp->user->phone }}</a>
                    </li>
                    <li>
                      <i class="fab fa-whatsapp"> Whatsapp: </i> <a class="pull-right"
                        href="https://wa.me/233201492986">
                        {{ $singleProp->user->phone }}</a>
                    </li>
                  @else
                    <li>
                      <i class="far fa-envelope">Email: </i> <a class="pull-right" href="mailto:info@luwoap.com">
                        info@luwoap.com </a>
                    </li>
                    <li>
                      <i class="fa fa-phone">Phone:</i> <a class="pull-right" href="tel:233201492986">
                        +233 20 149 2986</a>
                    </li>
                    <li>
                      <i class="fab fa-whatsapp">Whatsapp: </i> <a class="pull-right"
                        href="https://wa.me/233201492986">
                        +233 20 149 2986</a>
                    </li>
                  @endif
                </ul>
              </div>
            </div>
          </div>

          <!-- Rate Property -->
          {{-- <div class="sidebar-right rounded">
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
          </div> --}}

          <div class="sidebar-right rounded d-none d-lg-block">
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
                  <a target="_blank" rel="noopener noreferrer"
                    href="https://www.facebook.com/sharer/sharer.php?u={{ route("single.prop", $singleProp->slug) }}&quote={{ $singleProp->title }}">
                    <div class="icon facebook">
                      <div class="tooltip">Facebook</div>
                      <span><i class="fab fa-facebook"></i></span>
                    </div>
                  </a>
                  <a target="_blank" rel="noopener noreferrer"
                    href="https://twitter.com/intent/tweet?text={{ $singleProp->title }}&url={{ route("single.prop", $singleProp->slug) }}">
                    <div class="icon twitter">
                      <div class="tooltip">Twitter</div>
                      <span><i class="fab fa-twitter"></i></span>
                    </div>
                  </a>

                  <a target="_blank" rel="noopener noreferrer"
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

      <!--Related Properties -->
      <div class="row">
        <div class="col-lg-8">
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
      </div>

    </div>
  </div>

  <div class="position-fixed bottom-0 end-0 p-3 d-none" id="toast-div" style="bottom: 15%; right: 0; z-index: 100">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
      </div>
    </div>
  </div>

  <!-- Toast -->
  {{-- <div class="position-fixed p-3" id="toast-div" style="bottom: 15%; right: 0; z-index: 999999">
    <div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true"
      id="liveToast">
      <div class="d-flex">
        <div class="toast-body">
          <!-- This will be dynamically filled by the JavaScript -->
          <p>this is in the body</p>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
          aria-label="Close"></button>
      </div>
    </div>
  </div> --}}
  <!-- end Toast -->

  <!-- Modal for comments replies -->
  <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="morecomments" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-body">
          <ul id="repliesList"></ul> <!-- Container for replies -->
        </div>
      </div>
    </div>
  </div>

  <!--  -->
  <div class="action-bar container d-md-none">
    <a href="tel:+233201492986">
      <div class="call-action action-group">
        <span class="fa fa-phone-alt"></span>
        <p>CALL</p>
      </div>
    </a>

    <a id="whatsapp-link" href="#" target="_blank">
      <div class="whatsapp-action action-group">
        <span class="fab fa-whatsapp"></span>
        <p>WHATSAPP</p>
      </div>
    </a>

    <a id="email-link" href="#">
      <div class="email-action action-group">
        <span class="fas fa-envelope"></span>
        <p>EMAIL</p>
      </div>
    </a>

  </div>
  <!--  -->

@endsection

@push("scripts")
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Dynamic content for whatsapp link
      const phoneNumber = '233201492986';

      const whatsappTemplate = `Hello!%0A%0AI am interested in this property:%0A%0A`;

      const currentUrl = encodeURIComponent(window.location.href);

      const fullMessage = `${whatsappTemplate}${currentUrl}`;

      // Update the WhatsApp link
      const whatsappLink = document.getElementById('whatsapp-link');
      whatsappLink.href = `https://wa.me/${phoneNumber}?text=${fullMessage}`;

      // Dynamic content for Email link
      const emailAddress = 'info@luwoap.com';
      const subject = encodeURIComponent('Inquiry about a property');

      const mailTemplate = `Hello,%0A%0AI am interested in this property:%0A`;

      // Combine the message template with the current URL
      const body = `${mailTemplate}${currentUrl}`;

      // Update the email link
      const emailLink = document.getElementById('email-link');
      emailLink.href = `mailto:${emailAddress}?subject=${subject}&body=${body}`;

    });
  </script>
  <script>
    if ($("#request_callback_form").length > 0) {
      $("#request_callback_form").on("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        let form = this;
        let submitButton = $(form).find("button[type='submit']");

        // Disable the button and show loading spinner
        submitButton.prop("disabled", true);
        submitButton.html(
          '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
        );

        $.ajax({
          url: $(form).attr("action"),
          method: "POST",
          data: $(form).serialize(),
          success: function(response) {
            // Reset the submit button to its original state
            submitButton.prop("disabled", false);
            submitButton.html("Submit");

            if (response.error) {
              showToast(response.message, "bg-danger");
            } else {
              form.reset();
              showToast(response.message, "bg-success");
            }
          },
          error: function(xhr, status, error) {
            // Reset the submit button to its original state
            submitButton.prop("disabled", false);
            submitButton.html("Submit");

            console.error("Error:", xhr.responseText);
            showToast("Error: Something went wrong.", "bg-danger");
          }
        });
      });
    }
  </script>
  <script>
    $('#comment_form').on('submit', function(event) {
      event.preventDefault();

      let form = this;

      // show the loading screen
      $('#loading-screen').show();

      $.ajax({
        url: "{{ route("comments.store") }}",
        method: "POST",
        data: $(form).serialize(),
        success: function(response) {
          // Handle successful response
          $('#loading-screen').hide();
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
          $('#loading-screen').hide();
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
    // Reply function
    function reply(caller) {
      var parentId = $(caller).data('parent-id');
      var parentComment = $(caller).closest('.comment');
      var repliesDiv = parentComment.find('.repliesDiv');
      repliesDiv.find('input[name="parent_id"]').val(parentId);
      repliesDiv.toggle();
    }
  </script>
  <script>
    var commentStoreRoute = "{{ route("comments.store") }}";
    var replyStoreRoute = "{{ route("reply.store") }}";
  </script>
@endpush
