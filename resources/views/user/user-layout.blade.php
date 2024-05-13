@extends("layouts.app")

@section("content")
  {{-- @php
    $pageTitle = "";
    if (Request::is("user/user-profile")) {
        $pageTitle = "My Profile";
    } elseif (Request::is("manage-properties")) {
        $pageTitle = "Manage Properties";
    } elseif (Request::is("incoming-requests")) {
        $pageTitle = "Incoming Request";
    } elseif (Request::is("submit-property")) {
        $pageTitle = "Upload Property";
    } else {
        $pageTitle = "Edit Property";
    }

  @endphp --}}

  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>
          {{-- {{ $pageTitle }} --}}
        </h1>
        <ul class="breadcrumbs">
          <li><a href="/user/user-profile">Home</a></li>
          <li class="active">
            {{-- {{ $pageTitle }} --}}
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->

  <!-- Dashbord start -->
  <div class="dashboard content-area-16">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="dashboard-nav-2">
            <div class="ssss clearfix">
              <!--header -->
              <div class="header clearfix">
                <div class="header-inner clip-home">
                  <h2>{{ Auth::user()->name }}</h2>
                  <h4>Realtor</h4>
                </div>
                <div class="profile-photo">
                  <div class="profile-photo-inner">
                    <img src="{{ asset("assets/img/avatar/avatar-1.jpg") }}" alt="avatar" class="img-fluid use-ing">
                    {{-- <div class="change-photo-btn">
                                            <div class="photoUpload">
                                                <span><i class="fa fa-upload"></i></span>
                                                <input type="file" class="upload">
                                            </div>
                                        </div> --}}
                  </div>
                </div>
              </div>
              <!-- Detail -->
              <div class="detail clearfix">
                <ul>
                  <li>
                    <a href="/user/user-profile" class="bdr{{ Request::is("user/user-profile") ? " active" : "" }}">
                      <i class="flaticon-user"></i>My Profile
                    </a>
                  </li>
                  <li>
                    <a href="/manage-properties">
                      <i class="flaticon-architecture-and-city-1"></i>Manage Properties
                    </a>
                    {{-- @if (route("update.prop", $prop->id))
                      <a href="/user/my-property" class="active">
                        <i class="flaticon-architecture-and-city-1"></i>My Properties
                      </a>
                    @endif --}}
                  </li>
                  <li>
                    <a href="/incoming-requests" class="{{ Request::is("incoming-requests") ? "active" : "" }}">
                      <i class="flaticon-alarm"></i>Incoming Requests
                    </a>
                  </li>

                  @php
                    $disableClass = Auth::user()->role === null ? "disabled" : "";
                  @endphp

                  <li class="{{ Auth::user()->role == null ? "d-none" : "" }}">
                    <a href="/submit-property" class="{{ Request::is("submit-property") ? "active" : "" }}">
                      <i class="flaticon-plus"></i>Add New Property
                    </a>
                  </li>
                  <li>
                    <form method="POST" action="{{ route("logout") }}">
                      @csrf
                      <a href="route('logout')"
                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"><i
                          class="flaticon-logout"></i> Signout</a>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12">
          {{-- Dashboard content  --}}
          @yield("content")
          {{-- Dashboard content End --}}
        </div>
      </div>
    </div>
  </div>
  <!-- Dashbord end -->
@endsection
