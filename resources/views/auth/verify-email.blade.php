@extends("layouts.verified")

@section("content")
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session("status")" />

  <!-- Login form start -->
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
                <img src="{{ asset("assets/img/logos/luwoap-dark.png") }}" alt="logo">
              </a>
              <h3>Verify Email</h3>
              <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Thanks for signing up! Before getting started, verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will send you another.') }}
              </div>

              @if (session("status") == "verification-link-sent")
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                  {{ __("A new verification link has been sent to the email address you provided during registration.") }}
                </div>
              @endif

              <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route("verification.send") }}">
                  @csrf
                  <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __("If you did not receive the email.") }}
                  </div>

                  <div>
                    <button class="btn-md btn-theme w-100">
                      Resend Verification Email
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endsection
