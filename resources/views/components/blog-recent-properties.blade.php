<!-- Recent properties start -->
<div class="widget recent-properties">
  <h3 class="sidebar-title">Recent Properties</h3>
  <div class="s-border"></div>
  <div class="m-border"></div>
  <ul class="list-unstyled list-cat">
    @foreach ($recentProps["props"] as $prop)
      <li>
        <div class="d-flex mb-3 recent-posts-box">
          <a class="pr-3" href="{{ route("single.prop", $prop->slug) }}">
            <img loading="lazy" src="{{ asset("storage/uploads/ft_images/" . $prop->ft_image) }}"
              alt="{{ $prop->title }}" class="flex-shrink-0 me-3">
          </a>
          <div class="detail align-self-center">
            <h5>
              <a href="{{ route("single.prop", $prop->slug) }}">{{ $prop->title }}</a>
            </h5>
            <div class="listing-post-meta">
              {{ $prop->currency }}{{ $prop->price }}
            </div>
          </div>
        </div>
      </li>
    @endforeach
  </ul>
</div>
