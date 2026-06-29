@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-header clearfix">
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <h4>Edit Property</h4>
        </div>
      </div>
    </div>
    <div class="submit-address dashboard-list">
      <form method="POST" action="{{ route("update.prop", $prop->id) }}" enctype="multipart/form-data">
        @csrf
        @method("put")
        <h4 class="bg-grea-3">Basic Information</h4>
        <div class="search-contents-sidebar">
          <div class="row pad-20">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="property-title">Property Title</label>
                <input type="text" id="title" name="title" class="form-control selectpicker search-fields"
                  placeholder="Property Title" value="{{ $prop->title }}">
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
                  <option value="For Sale">For Sale</option>
                  <option value="Rent">Rent</option>
                  <option value="Lease">Lease</option>
                </select>
                @error("offer_type")
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <label>Price</label>
                    <input type="text" name="price" id="price" class="form-control selectpicker search-fields"
                      value='{{ $prop->price }}'>
                    @error("price")
                      {{ $message }}
                    @enderror
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="currency">Currency</label>
                    <select class="selectpicker search-fields" name="currency" id="currency">
                      <option value=""></option>
                      <option value="GHC">GHC</option>
                      <option value="$">USD</option>
                    </select>
                    @error("currency")
                      {{ $message }}
                    @enderror
                  </div>
                </div>

              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control selectpicker search-fields"
                  placeholder="eg. Dansoman - Accra, Haatso.." value='{{ $prop->location }}'>
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
                      placeholder="Bed" value='{{ $prop->bed }}'>
                    @error("bed")
                      {{ $message }}
                    @enderror
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6">
                    <label for="bath">Bath</label>
                    <input type="number" id="bath" name="bath" min="1" max="10"
                      class="form-control search-fields" placeholder="Bath" value='{{ $prop->bath }}'>
                    @error("bath")
                      {{ $message }}
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
                  value='{{ $prop->sqm }}'>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="category">Category</label>
                <select class="selectpicker search-fields" name="category" id="category" value="{{ $prop->category }}">
                  <option value=""></option>
                  <option value="Airbnb">Airbnb</option>
                  <option value="Appartment">Apartment</option>
                  <option value="Commercial Space">Commercial Space</option>
                  <option value="Guest House">Guest House</option>
                  <option value="Hostel">Hostel</option>
                  <option value="Hotel">Hotel</option>
                  <option value="House">House</option>
                  <option value="Luxury App">Luxury Apartment</option>
                  <option value="Office Space">Office Space</option>
                </select>
                @error("category")
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="ft_image">Feature Image <small> (Main property thumbnail)</small></label>
                <input type="file" name="ft_image" id="ft_image" class="form-control search-fields">

                <br>
                <img loading="lazy" class="d-block w-50 rounded"
                  src="{{ asset("storage/uploads/ft_images/" . $prop->ft_image) }}" alt="listing-photo">
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
            <textarea class="input-text" name="more_info" placeholder="Detailed Information">{{ $prop->more_info }}</textarea>
            @error("more_info")
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <input type="text" class="d-none" id="amenity" value="{{ $prop->amenities }}">
        <h4 class="bg-grea-3">Gallery</h4>
        <div class="row pad-20">
          <div class="col-lg-12">
            <input type="file" id="image" class="filepond" name="image[]" multiple data-allow-reorder="true"
              data-max-file-size="3MB" data-max-files="10">
            <div class="row">
              @foreach ($propImages as $propImage)
                <div class="col-lg-4 col-md-6 col-sm-6">
                  <br>
                  <div class="portfolio-item">
                    <a href="{{ asset("storage/uploads/$propImage->prop_id/" . $propImage->image) }}"
                      title="{{ $prop->title }}">
                      <img loading="lazy" src="{{ asset("storage/uploads/$propImage->prop_id/" . $propImage->image) }}"
                        alt="gallery-photo" class="img-fluid">
                    </a>
                    <div class="portfolio-content">
                      <div class="portfolio-content-inner">
                        <span><i class="fa fa-search"></i></span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            @error("image")
              <p class="text-danger">{{ $message }}</p>
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
            <button class="btn btn-md button-theme" type="submit">Update Property</button>
          </div>
        </div>

      </form>
    </div>
  </div>
@endsection

{{-- notification toast --}}
@if (session()->has("success"))
  <div x-data='{show:true}' x-init="setTimeOut(() => show = false, 3000)" x-show="show" class="position-fixed bottom-0 right-0 p-3"
    style="z-index: 999" style="z-index: 5; right: 0; bottom: 0;">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true"
      data-delay="2000">
      <div class="toast-header">
        <!-- <img loading="lazy" src="..." class="rounded mr-2" alt="..."> -->
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

@push("scripts")
  <script>
    $(document).ready(function() {

      // Call setSelectedOption for each property type, currency, and category
      setSelectedOption("{{ $prop->offer_type }}", "offer_type");
      setSelectedOption("{{ $prop->currency }}", "currency");
      setSelectedOption("{{ $prop->category }}", "category");

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


      // Get the string of checkbox IDs
      var amenities = $('#amenity').val();

      // Split the string into an array of checkbox IDs
      var checkboxIds = amenities.split(',');

      // Loop through each checkbox ID
      checkboxIds.forEach(function(id) {
        // Get the checkbox element by ID
        var checkbox = document.getElementById(id);

        // Check if the checkbox element exists
        if (checkbox) {
          // Check the checkbox
          checkbox.checked = true;
        }
      });

    });
  </script>

  <script>
    // This function auto selects the option of a select input using value from Db
    function setSelectedOption(dbValue, selectId) {
      if (dbValue) {
        // Loop through each option in the select element
        $('#' + selectId + ' option').each(function() {
          // Check if the value of the option matches the value from the database
          if ($(this).val() === dbValue) {
            // If it matches, set the selected attribute to true
            $(this).prop('selected', true);
          }
        });
      }
    }
  </script>
@endpush
