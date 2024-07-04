@extends("layouts.app")

@section("content")
  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>{{ $postDetails->post_title }}</h1>
        <ul class="breadcrumbs">
          <li><a href="/">Home</a></li>
          <li class="active">Posts/Blogs</li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Sub Banner end -->

  <!-- Blog body start -->
  <div class="blog-body content-area">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-12">
          <!-- Blog 1 start -->
          <div class="blog-1 blog-big">
            <div class="blog-photo">
              <img src="{{ asset("storage/posts/" . $postDetails->post_ft_image) }}" alt="{{ $postDetails->slug }}"
                class="img-fluid w-100">
            </div>
            <div class="detail">
              <h3>
                <a href="#">{{ $postDetails->post_title }}</a>
              </h3>
              {!! $postDetails->post_content !!}
              <br>
              <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="blog-tags">
                    <span>Tags</span>
                    @foreach ($currentPostTags as $tag)
                      <a href="{{ route("posts.byTag", ["tag" => urlencode($tag)]) }}">{{ $tag }}</a>
                    @endforeach

                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <x-blog-sidebar :commonTags="$commonTags" />
        </div>
      </div>
    </div>
  </div>
  <!-- Blog body end -->
@endsection
