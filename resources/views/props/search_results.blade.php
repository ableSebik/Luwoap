@extends("layouts.app")

@section("content")
  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>
          Search Results
        </h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">
            Search Results
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
                {{-- <h3>Showing {{ $firstItem }}-{{ $lastItem }} of {{ $totalItems }} Listings</h3> --}}
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="sorting-options">
                  <a href="#" class="change-view-btn"><i class="fa fa-th-list"></i></a>
                  <a href="#" class="change-view-btn active-view-btn"><i class="fa fa-th-large"></i></a>
                </div>
                <div class="sorting-options2">
                  <select class="selectpicker search-fields" name="default-order">
                    <option>Sort by: Default</option>
                    <option>Price High to Low</option>
                    <option>Price: Low to High</option>
                    <option>Newest listing</option>
                    <option>Oldest listing</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            @if (!empty($filteredProperties))
              @foreach ($filteredProperties as $filteredProperty)
                <div class="col-lg-4 col-md-6 col-sm-12">
                  <x-property-box :prop="$filteredProperty" />
                </div>
              @endforeach
            @else
              <div class="col-lg-4 col-md-6 col-sm-12">
                <h4>No results</h4>
              </div>
            @endif
          </div>
          <!-- Pagination start -->
          {{ $filteredProperties->links("vendor.pagination.bootstrap-4") }}
        </div>
      </div>
    </div>
  </div>
  {{-- End Property listings --}}
@endsection
