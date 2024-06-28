@extends("layouts.app")

@section("content")
  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>Contact Us</h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">Contact Us</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->

  <!-- Contact 2 start -->
  <div class="content-area-6 contact-2">
    <div class="container">
      <!-- Main title -->
      <div class="main-title text-center">
        <h1>Get in Touch</h1>
        <p>We’re here to help with any questions you may have. Whether you’re buying, selling, or renting, our team is
          ready to assist you.</p>
      </div>
      <form action="#" method="GET" enctype="multipart/form-data">
        <div class="row g-0 contact-innner">
          <div class="col-lg-7">
            <div class="contact-form">
              <h3 class="mb-20">Send us a Message</h3>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group name">
                    <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Full Name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group email">
                    <input type="email" name="email" class="form-control" placeholder="Email Address"
                      aria-label="Email Address">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group subject">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" aria-label="Subject">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group number">
                    <input type="text" name="phone" class="form-control" placeholder="Phone"
                      aria-label="Phone Number">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group message">
                    <textarea class="form-control" name="message" placeholder="Write message" aria-label="Write message"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="send-btn text-center">
                    <button type="submit" class="btn-6">Send Message</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="contact-info">
              <h3 class="mb-20">Contact Info</h3>
              <div class="ca-box d-flex mb-30">
                <i class="flaticon-pin me-3"></i>
                <div class="detail">
                  <h5>Address</h5>
                  <p>Adenta, Accra</p>
                </div>
              </div>
              <div class="ca-box d-flex mb-30">
                <i class="flaticon-phone me-3"></i>
                <div class="detail">
                  <h5>Phone Number</h5>
                  <p><a href="tel:+233-20-149-2986">+233-20-149-2986</a></p>
                </div>
              </div>
              <div class="ca-box d-flex mb-30">
                <i class="fab fa-whatsapp me-3 "></i>
                <div class="detail">
                  <h5>Whatsapp</h5>
                  <p><a href="https://wa.me/233201492986">+233-20-149-2986</a></p>
                </div>
              </div>
              <h3 class="mb-20">Follow Us</h3>
              <div class="social-media clearfix">
                <div class="social-list">
                  <a target="blank" href="">
                    <div class="icon facebook">
                      <div class="tooltip">Facebook</div>
                      <span><i class="fab fa-facebook"></i></span>
                    </div>
                  </a>
                  <a target="blank" href="">
                    <div class="icon twitter">
                      <div class="tooltip">Twitter</div>
                      <span><i class="fab fa-twitter"></i></span>
                    </div>
                  </a>

                  <a target="blank" href="">
                    <div class="icon linkedin mr-0">
                      <div class="tooltip">LinkedIn</div>
                      <span><i class="fab fa-linkedin"></i></span>
                    </div>
                  </a>
                  <a target="blank" href="">
                    <div class="icon instagram mr-0">
                      <div class="tooltip">Instagram</div>
                      <span><i class="fab fa-instagram"></i></span>
                    </div>
                  </a>
                  <a target="blank" href="">
                    <div class="icon tiktok mr-0">
                      <div class="tooltip">Tiktok</div>
                      <span><i class="fab fa-tiktok"></i></span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Contact 2 end -->

  {{-- <!-- Google map start -->
  <div class="section contact-2-map ">
    <div class="map">
      <div id="map" class="contact-map"></div>
    </div>
  </div>
  <!-- Google map end --> --}}
@endsection

@push("scripts")
  <script src="https://maps.googleapis.com/maps/api/js?key={{ env("GOOGLE_MAPS_API_KEY") }}&callback=initMap" async defer>
  </script>
  <script>
    // function initMap() {
    //   var mapOptions = {
    //     center: new google.maps.LatLng(5.650700791457598, -0.19619221790322847),
    //     zoom: 8
    //   };
    //   var map = new google.maps.Map(document.getElementById("map"), mapOptions);
    // }

    function initMap() {
      var mapOptions = {
        center: new google.maps.LatLng(5.650700791457598, -0.19619221790322847),
        zoom: 15
      };
      var map = new google.maps.Map(document.getElementById("map"), mapOptions);

      // Add a marker
      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(5.650700791457598, -0.19619221790322847),
        map: map,
        title: "We're here!"
      });
    }
  </script>
@endpush
