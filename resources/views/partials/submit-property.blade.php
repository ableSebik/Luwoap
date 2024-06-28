@extends("user.admin-dashboard")

@section("content")
  <div class="submit-address dashboard-list advanced-search">
    <form method="POST" id="create-property-form" action="{{ route("property.create") }}" enctype="multipart/form-data">
      @csrf
      <h4 class="bg-grea-3">Basic Information</h4>
      <div class="search-contents-sidebar">
        <div class="row pad-20">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="property-title">Property Title</label>
              <input type="text" id="title" name="title" class="form-control selectpicker search-fields"
                placeholder="Property Title" value="{{ old("title") }}">
              @error("title")
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="offer_type">Status</label>
              <select class="selectpicker search-fields" name="offer_type" id="offer_type">
                <option value=""></option>
                <option value="sale">For Sale</option>
                <option value="rent">Rent</option>
                <option value="lease">Lease</option>
              </select>
              @error("offer_type")
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="category">Category</label>
              <select class="selectpicker search-fields" name="category" id="category">
                <option value=""></option>
                <option value="air bnb">Airbnb</option>
                <option value="apartment">Apartment</option>
                <option value="commercial space">Commercial Space</option>
                <option value="guest house">Guest House</option>
                <option value="hostel">Hostel</option>
                <option value="hotel">Hotel</option>
                <option value="house">House</option>
                <option value="luxury apartment">Luxury Apartment</option>
                <option value="office space">Office Space</option>
              </select>
              @error("category")
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="location">Location</label>
              <input type="text" name="location" id="location" class="form-control selectpicker search-fields"
                placeholder="eg. Dansoman - Accra, Haatso.." value='{{ old("location") }}'>
              @error("location")
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="bed">Bed</label>
                  <input type="number" name="bed" min="1" max="10" class="form-control search-fields"
                    placeholder="Bed" value='{{ old("bed") }}'>
                  @error("bed")
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="bath">Bath</label>
                  <input type="number" id="bath" name="bath" min="1" max="10"
                    class="form-control search-fields" placeholder="Bath" value='{{ old("bath") }}'>
                  @error("bath")
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="sqm">Square Metre</label>
              <input type="text" pattern="\d+(\.\d{1,2})?" name="sqm" id="sqm"
                class="form-control selectpicker search-fields" placeholder="Property size (sqm)"
                value='{{ old("sqm") }}'>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label>Price</label>
                  <input type="text" name="price" id="price" class="form-control selectpicker search-fields"
                    value='{{ old("price") }}'>
                  @error("price")
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <label for="currency">Currency</label>
                  <select class="selectpicker search-fields" name="currency" id="currency">
                    <option value=""></option>
                    <option value="GHC" selected>GHC</option>
                    <option value="$">USD</option>
                  </select>
                  @error("currency")
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group" id="price_range_group">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <label for="price_range">Price Range <small> (For Hostel property only)</small></label>
                  <input type="text" name="price_range" id="price_range"
                    class="form-control selectpicker search-fields" value='{{ old("price_range") }}'>
                  @error("price_range")
                    <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group" id="period_group">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <label for="currency">Period</label>
                  <select class="selectpicker search-fields" name="period" id="period">
                    <option value=""></option>
                    <option value="yr">Year</option>
                    <option value="mth">Month</option>
                    <option value="day">Day</option>
                    <option value="sem">Semester</option>
                  </select>
                  @error("period")
                    {{ $message }}
                  @enderror
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="ft_image">Feature Image <small> (Main property thumbnail)</small></label>
              <input type="file" name="ft_image" id="ft_image" class="form-control search-fields">
              @error("ft_image")
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
      </div>
      <h4 class="bg-grea-3">Detailed Information</h4>
      <div class="row pad-20">
        <div class="col-lg-12">
          <textarea class="input-text" name="more_info" id="more_info" placeholder="Detailed Information">{{ old("more_info") }}</textarea>
          @error("more_info")
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <h4 class="bg-grea-3">Gallery</h4>
      <div class="row pad-20">
        <div class="col-lg-12">
          <input type="file" id="image" class="form-control search-fields" name="image[]" multiple
            data-allow-reorder="true" data-max-file-size="3MB" data-max-files="10">
          @error("image")
            <p class="text-danger">*Select at least one image.</p>
          @enderror
        </div>
      </div>

      <h4 class="bg-grea-3">Amenities (optional)</h4>
      <div class="row pad-20">
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="ac" value="ac" name="amenities[]" type="checkbox">
            <label for="ac">
              Air Condition
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="kitchen" value="kitchen" name="amenities[]" type="checkbox">
            <label for="kitchen">
              Kitchen
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="conference" value="conference" name="amenities[]" type="checkbox">
            <label for="conference">
              Conference Room
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="pool" value="pool" name="amenities[]" type="checkbox">
            <label for="pool">
              Swimming Pool
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="security" value="security" name="amenities[]" type="checkbox">
            <label for="security">
              Security
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="gym" value="gym" name="amenities[]" type="checkbox">
            <label for="gym">
              Gym
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="garage" value="garage" name="amenities[]" type="checkbox">
            <label for="garage">
              Garage
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="study" value="study" name="amenities[]" type="checkbox">
            <label for="study">
              Study Room
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="parking" value="parking" name="amenities[]" type="checkbox">
            <label for="parking">
              Parking
            </label>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="checkbox checkbox-theme checkbox-circle">
            <input id="cctv" value="CCTV" name="amenities[]" type="checkbox">
            <label for="cctv">
              CCTV
            </label>
          </div>
        </div>
      </div>
      <h4 class="bg-grea-3"></h4>
      <div class="row pad-20">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <button class="btn btn-md button-theme" type="submit">Upload Property</button>
        </div>
      </div>
    </form>
  </div>
  </div>
@endsection

@push("scripts")
  {{-- notification toast --}}
  @if (session()->has("success"))
    <div x-data='{show:true}' x-init="setTimeOut(() => show = false, 3000)" x-show="show" class="position-fixed bottom-0 right-0 p-3"
      style="z-index: 999" style="z-index: 5; right: 0; bottom: 0;">
      <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
        data-delay="2000">
        <div class="toast-header">
          <!-- <img src="..." class="rounded mr-2" alt="..."> -->
          <strong class="mr-auto">Success</strong>
          <small>Just now</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          {{ session("success") }}
        </div>
      </div>
    </div>
  @endif
  @if (session()->has("error"))
    <div x-data='{show:true}' x-init="setTimeOut(() => show = false, 3000)" x-show="show" class="position-fixed bottom-0 right-0 p-3"
      style="z-index: 999" style="z-index: 5; right: 0; bottom: 0;">
      <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
        data-delay="2000">
        <div class="toast-header">
          <!-- <img src="..." class="rounded mr-2" alt="..."> -->
          <strong class="mr-auto">Error</strong>
          <small>Just now</small>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
          {{ session("error") }}
        </div>
      </div>
    </div>
  @endif

  <script>
    $('#sqm, #price').on('input', function() {
      // Remove non-numeric characters except decimal point
      var value = $(this).val().replace(/[^0-9.]/g, '');

      // Split the value into integer and fractional parts
      var parts = value.split('.');

      // If the value starts with a dot, add a leading zero
      if (value.startsWith('.')) {
        value = '0' + value;
      }

      // Ensure there's at most one decimal point
      if (parts.length > 2) {
        // More than one decimal point, keep only the first part
        value = parts[0] + '.' + parts.slice(1).join('');
      }

      // If there's a fractional part, limit it to two digits
      if (parts[1]) {
        parts[1] = parts[1].slice(0, 2);
        value = parts.join('.');
      }

      // Format the value with commas as thousands separators
      value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

      // Update the input value
      $(this).val(value);
    });
  </script>

  <script>
    $(document).ready(function() {

      // Initially hide the price range group
      togglePriceRange();
      togglePeriod();

      // Set up event listener for changes in the select input
      $('#category').change(function() {
        togglePriceRange();
      });
      $('#offer_type').change(function() {
        togglePeriod();
      });
      // Function to toggle visibility based on selection
      function togglePriceRange() {
        if ($('#category').val() === 'hostel') {
          $('#price_range_group').show();
        } else {
          $('#price_range_group').hide();
        }
      }

      //Function to toggle vissibilty of Period if category != "sale"
      function togglePeriod() {
        if (['rent', 'lease'].includes($('#offer_type').val())) {
          $('#period_group').show();
        } else {
          $('#period_group').hide();
        }
      }


    });
  </script>
@endpush
