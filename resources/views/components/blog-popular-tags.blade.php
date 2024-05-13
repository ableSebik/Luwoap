<div class="widget-3 tags-box">
  <h3 class="sidebar-title">Popular Tags</h3>
  <div class="s-border"></div>
  <div class="m-border"></div>
  <ul class="tags">
    @foreach ($commonTags as $commonTag => $count)
      <li><a href="{{ route("posts.byTag", $commonTag) }}">{{ $commonTag }}</a></li>
    @endforeach

  </ul>
</div>
