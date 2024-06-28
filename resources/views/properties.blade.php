@extends("layouts.app")

@section("content")
  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>
          Properties
        </h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">
            Properties
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->
  <div class="container-fluid" style="width: 100vw">
    <div class="category-list">
      <a href="{{ route("house.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Houses">
        <i class="fas fa-home"></i>
      </a>

      <a href="{{ route("hostel.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Hostel">
        <i class="fa fa-bed"></i>
      </a>

      <a href="{{ route("airbnb.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Air BnB">
        <i class="fab fa-airbnb"></i>
      </a>

      <a href="{{ route("office.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Office Spaces">
        <i class="fa fa-briefcase"></i>
      </a>

      <a href="{{ route("luxury.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Luxury Apartment">
        <i class="fa fa-gem"></i>
      </a>
      <a href="{{ route("guest.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Guest House">
        <i class="fas fa-hotel"></i>
      </a>

      <a href="{{ route("apartment.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip"
        data-bs-placement="bottom" title="Apartments">
        <i class="fa fa-building"></i>
      </a>
      <a href="{{ route("hotel.prop") }}" class="service-info-4-link" data-bs-toggle="tooltip" data-bs-placement="bottom"
        title="Commercial Space">
        <i class="fas fa-luggage-cart"></i>
      </a>
    </div>
  </div>

  {{-- Property listings --}}
  <div class="property-section content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title">
        <p>BROWSE HOT OFFERS</p>
        <h1>Latest Properties</h1>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <!-- Option bar start -->
          <div class="option-bar">
            <span class="alert">Showing {{ $firstItem }}-{{ $lastItem }} of {{ $totalItems }}
              Listings</span>
          </div>
          <div class="row">
            @foreach ($props as $prop)
              <div class="col-lg-4 col-md-6 col-sm-12">
                <x-property-box :prop="$prop" />
              </div>
            @endforeach

          </div>
          <!-- Pagination start -->
          {{ $props->links("vendor.pagination.bootstrap-4") }}
        </div>
      </div>
    </div>
  </div>
  {{-- End Property listings --}}
@endsection
