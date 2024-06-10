{{-- @extends("layouts.auth")

@section("content")
  <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __("Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.") }}
  </div>

  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session("status")" />

  <form method="POST" action="{{ route("password.email") }}">
    @csrf

    <!-- Email Address -->
    <div>
      <x-input-label for="email" :value="__("Email")" />
      <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old("email")" required
        autofocus />
      <x-input-error :messages="$errors->get("email")" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
      <x-primary-button>
        {{ __("Email Password Reset Link") }}
      </x-primary-button>
    </div>
  </form>
@endsection --}}

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
              <h3>Reset Password</h3>
              <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __("Forgot your password? Enter your email address and we will email you a password reset link.") }}
              </div>

              <!-- Session Status -->
              <x-auth-session-status class="mb-4" :status="session("status")" />

              <form method="POST" action="{{ route("password.email") }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group form-box">
                  <input type="text" id="email" name="email" class="form-control" placeholder="Email Address"
                    :value="old('email')" autofocus autocomplete="username">
                  @error("email")
                    <p class="text-danger pull-left mb-4">{{ $message }}</p>
                  @enderror
                </div>

                <div class="form-group">
                  <button type="submit" class="btn-md btn-theme w-100">Email Password Reset Link</button>
                </div>
                <p>Have an account?<a href="{{ route("login") }}" class="text-primary"> login</a> here, or creat account<a
                    href="{{ route("register") }}" class="text-primary"> signup</a></p>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if (session()->has("session_timeout"))
    <div x-data='{show:true}' x-init="setTimeout(() => show = false, 3000)" x-show="show" class="position-fixed bottom-0 right-0 p-3"
      style="z-index: 5555; right: 0; bottom: 0;">
      <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
        <div class="toast-header">
          <small>Just now</small>
          <button type="button" class="ml-2 mb-1 close" @click="show = false" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          <div class="alert alert-success">
            <p>{{ session("session_timeout") }}</p>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection
