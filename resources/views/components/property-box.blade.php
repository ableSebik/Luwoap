{{-- <div class="property-box">
  <div class="property-photo">
    <a href="{{ route("single.prop", $prop->id) }}" class="property-img">
      <div class="tag">{{ $prop->offer_type }}</div>
      <div class="category-box">{{ $prop->category }}</div>
      <div class="price-box">{{ $prop->currency }} {{ $prop->price }}<span></span></div>
      <img class="d-block w-100" src="{{ asset("storage/uploads/ft_images/" . $prop->ft_image) }}" alt="properties">
    </a>
  </div>
  <div class="detail">
    <h1 class="title">
      <a href="{{ route("single.prop", $prop->id) }}">{{ $prop->title }}</a>
    </h1>

    <div class="location">
      <a href="{{ route("single.prop", $prop->id) }}">
        <i class="flaticon-pin"></i>{{ $prop->location }}
      </a>
    </div>
  </div>
  <ul class="facilities-list clearfix">
    <li>
      <span class="fa fa-bed"></span> {{ $prop->bed }}
    </li>
    <li>
      <span class="fa fa-bathtub"></span> {{ $prop->bath }}
    </li>
    @if ($prop->sqm != null)
      <li>
        <span class="fa fa-cube"></span>{{ $prop->sqm }} sqm
      </li>
    @endif
  </ul>
</div> --}}

<div class="property-box-4">
  <div class="property-photo">
    <img class="img-fluid w-100" src="{{ Storage::url("uploads/ft_images/" . $prop->ft_image) }}" alt="properties">
    <div class="tag">{{ $prop->offer_type }}</div>
    <div class="category-box">{{ $prop->category }}</div>
    <div class="plan-price"><sup>{{ $prop->currency }}</sup> {{ $prop->price }}
      @if ($prop->offer_type == "lease" || $prop->offer_type == "rent")
        <span>/month</span>
      @endif
    </div>
  </div>
  <div class="detail">
    <div class="heading">
      <h3>
        <a href="{{ route("single.prop", $prop->id) }}">{{ $prop->title }}</a>
      </h3>
      <div class="location">
        <a href="{{ route("single.prop", $prop->id) }}">
          <i class="fa fa-map-marker"></i>{{ $prop->location }}
        </a>
      </div>
    </div>
    <div class="properties-listing clearfix">
      <ul>
        <li><i class="flaticon-bed"></i> {{ $prop->bed }} Bedroom(s)</li>
        <li><i class="flaticon-bathroom"></i> {{ $prop->bath }} Washroom(s)</li>
        @if ($prop->sqm != null)
          <li><i class="flaticon-area"></i> {{ $prop->sqm }} sqm</li>
        @endif
      </ul>
    </div>
  </div>
</div>
