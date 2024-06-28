@extends("layouts.app")

@section("content")
  @php
    $pageTitle = "";
    if (Request::is("props/offer_type/for-sale")) {
        $pageTitle = "Properties for Sale";
    }
    if (Request::is("props/offer_type/rent")) {
        $pageTitle = "Properties for Rent";
    }
    if (Request::is("props/offer_type/lease")) {
        $pageTitle = "Lease Properties";
    }
    if (Request::is("props/category/hostel")) {
        $pageTitle = "Hostel Properties";
    }
    if (Request::is("props/category/airbnb")) {
        $pageTitle = "Air BnB";
    }
    if (Request::is("props/category/apartment")) {
        $pageTitle = "Apartment";
    }
    if (Request::is("props/category/office-space")) {
        $pageTitle = "Office Space";
    }
    if (Request::is("props/category/luxury-apartment")) {
        $pageTitle = "Luxury Properties";
    }
    if (Request::is("props/category/hotel")) {
        $pageTitle = "Hotel Properties";
    }
    if (Request::is("props/category/house")) {
        $pageTitle = "Housing Properties";
    }
    if (Request::is("props/category/guest-house")) {
        $pageTitle = "Guest House";
    }
    if (Request::is("props/category/commercial-property")) {
        $pageTitle = "Commercial Properties";
    }
  @endphp

  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>
          {{ $pageTitle }}
        </h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">
            {{ $pageTitle }}
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->

  {{-- Property listings --}}
  <div class="property-section content-area">
    <div class="container">
      <!-- Main title -->
      <div class="main-title">
        <h1>Latest Properties</h1>
        <p>BROWSE HOT OFFERS</p>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
          <!-- Option bar start -->
          <div class="option-bar">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <h3>Showing {{ $firstItem }}-{{ $lastItem }} of {{ $totalItems }} Listings</h3>
              </div>
            </div>
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
          {{-- <button type="button" class="btn-lg btn-theme float-right">More Properties</button> --}}
        </div>
      </div>
    </div>
  </div>
  {{-- End Property listings --}}
@endsection
