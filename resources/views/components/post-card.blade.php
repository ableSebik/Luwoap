<div class="blog-1">
  <div class="photo">
    <img src="{{ Storage::url("posts/" . $blogPost->post_ft_image) }}" alt="big-blog" class="img-fluid w-100">
    <div class="overlay-icon">
      <a href="{{ route("postDetails.blog", $blogPost->id) }}"><span><i class="fa fa-plus-square-o span"></i></span></a>
    </div>
    <div class="date-box">{{ $blogPost->post_day }} {{ $blogPost->post_month }}</div>
  </div>
  <div class="detail">
    <h3>
      <a href="{{ route("postDetails.blog", $blogPost->id) }}">{{ $blogPost->post_title }}</a>
    </h3>
    <p>{{ $blogPost->post_excerpt }}</p>
    <a href="{{ route("postDetails.blog", $blogPost->id) }}" class="read-more">Read more</a>
  </div>
</div>
