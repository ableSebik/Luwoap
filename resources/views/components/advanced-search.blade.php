<div class="widget advanced-search">
  <h3 class="sidebar-title">Find Property</h3>
  <div class="s-border"></div>
  <div class="m-border"></div>
  <form method="GET">
    <div class="form-group">
      <select class="selectpicker search-fields" name="any-status">
        <option>Offer</option>
        <option value="For Sale">For Sale</option>
        <option value="rent">Rent</option>
        <option value="lease">Lease</option>
      </select>
    </div>
    <div class="form-group">
      <select class="selectpicker search-fields" name="all-type">
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
    </div>
    <div class="row">
      <div class="col-sm-6 col-6">
        <div class="form-group">
          <input type="number" name="bed" min="1" max="10" class="form-control search-fields"
            placeholder="Bedroom" value='{{ old("bed") }}'>
        </div>
      </div>
      <div class="col-sm-6 col-6">
        <div class="form-group">
          <input type="number" id="bath" name="bath" min="1" max="10"
            class="form-control search-fields" placeholder="Bath" value='{{ old("bath") }}'>
        </div>
      </div>
    </div>

    <div class="range-slider clearfix">
      <label>Price Range</label>
      <div data-min="0" data-max="1000000" data-min-name="min_area" data-max-name="max_area" data-unit="GHC"
        class="range-slider-ui ui-slider" aria-disabled="false"></div>
      <div class="clearfix"></div>
    </div>
    <div class="form-group mt-3">
      <button class="search-button">Search</button>
    </div>
  </form>
</div>
