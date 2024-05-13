<div class="blog-1">
  <div class="photo">
    <img src="{{ asset("storage/Post/" . $blogPost->post_ft_image) }}" alt="big-blog" class="img-fluid w-100">
    <div class="overlay-icon">
      <a href="{{ route("postDetails.blog", $blogPost->id) }}"><span><i class="fa fa-plus-square-o span"></i></span></a>
    </div>
    <div class="date-box">{{ $postDay }} {{ $postMonth }}</div>
  </div>
  <div class="detail">
    <h3>
      <a href="{{ route("postDetails.blog", $blogPost->id) }}">{{ $blogPost->post_title }}</a>
    </h3>
    {{-- <div class="post-meta">
      <span><a href="#"><i class="flaticon-male"></i>Admin</a></span>
      <span><a href="#"><i class="flaticon-comment"></i>27</a></span>
      <span><a href="#"><i class="fa fa-heart-o"></i>27</a></span>
    </div> --}}
    <p>{{ $blogPost->post_excerpt }}</p>
    <a href="{{ route("postDetails.blog", $blogPost->id) }}" class="read-more">Read more</a>
  </div>
</div>
