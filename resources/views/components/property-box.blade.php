<div class="property-box-4">
  <div class="property-photo">
    <img class="img-fluid w-100" src="{{ Storage::url("uploads/ft_images/" . $prop->ft_image) }}"
      alt="{{ $prop->title }}">
    <div class="tag">{{ $prop->offer_type }}</div>
    <div class="category-box">{{ $prop->category }}</div>
    <div class="plan-price"><sup>{{ $prop->currency }}</sup>
      @if ($prop->category == "hostel")
        {{ $prop->price_range }}
      @else
        {{ $prop->price }}
      @endif
      @if ($prop->offer_type != "sale")
        <span>/{{ $prop->period }}</span>
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
