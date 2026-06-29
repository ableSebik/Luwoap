@extends("layouts.verified")

@section("content")
  <!-- Register form start -->
  <div class="contact-section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-7 col-md-12 bg-login-ing">
          <div class="informeson">
            <div class="typing">
              <h1>Welcome To LUWOAP</h1>
            </div>
            <p>From Real estate houses available for sale and rent, along with hostels, apartments,
              Airbnb rentals, and hotels, our expansive portfolio showcases a wide spectrum of properties spread across
              the Ghana.</p>
            <div class="social-list">
              <div class="buttons">
                <a href="#" class="facebook-bg"><i class="fa fa-facebook"></i></a>
                <a href="#" class="twitter-bg"><i class="fa fa-twitter"></i></a>
                <a href="#" class="google-bg"><i class="fa fa-google"></i></a>
                <a href="#" class="dribbble-bg"><i class="fa fa-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-12 form-section">
          <div class="login-inner-form">
            <div class="details">
              <a href="/">
                <img loading="lazy" src="{{ asset("assets/img/logos/luwoap-dark.png") }}" alt="logo">
              </a>
              <h3>Create An Account</h3>
              <form method="POST" action="{{ route("register") }}">
                @csrf

                <div class="form-group form-box">
                  <input type="text" name="name" class="form-control text-capitalize" value="{{ old("name") }}"
                    placeholder="Name" aria-label="Name">
                  @error("name")
                    <p class="text-danger pull-left mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group form-box">
                  <input type="email" name="email" class="form-control" value="{{ old("email") }}"
                    placeholder="Email Address" aria-label="Email Address" autocomplete="email">
                  @error("email")
                    <p class="text-danger pull-left mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group form-box">
                  <input type="tel" name="phone" class="form-control" value="{{ old("phone") }}" autocomplete="off"
                    placeholder="Phone" aria-label="Phone">
                  @error("phone")
                    <p class="text-danger pull-left mb-3">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group form-box">
                  <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password"
                    aria-label="Password">
                  @error("password")
                    <p class="text-danger pull-left mb-3">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group form-box">
                  <input type="password" required name="password_confirmation" class="form-control" autocomplete="off"
                    placeholder="Confirm Password" aria-label="Confirm Password">
                  @error("password_confirmation")
                    <p class="text-danger pull-left mb-3">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group form-box checkbox clearfix">
                  <div class="form-check checkbox-theme">
                    <input class="form-check-input" type="checkbox" value="" id="termsOfService">
                    <label class="form-check-label" for="termsOfService">
                      I agree to the<a href="#" class="terms">terms of service</a>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn-md btn-theme w-100">Register</button>
                </div>
                <p>Got account?<a href="{{ route("login") }}"> Login here</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Register form end -->
@endsection
