@extends("layouts.app")

@section("content")
  <!-- Sub banner start -->
  <div class="sub-banner">
    <div class="container">
      <div class="breadcrumb-area">
        <h1>Posts/Blogs</h1>
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
        <!-- list all posts -->
        @if (Request::is("blog"))
          <div class="col-lg-8 col-md-12">
            <!-- Blog 1 start -->
            @foreach ($blogPosts as $blogPost)
              <x-post-card :blogPost="$blogPost" :postDay="$post_day" :postMonth="$post_month" />
            @endforeach

            <!-- Blog 1 end -->

            <!-- Page navigation start -->
            <div class="pagination-box hidden-mb-45 text-center">
              {{ $blogPosts->links("vendor.pagination.bootstrap-4") }}
            </div>
            <!-- Page navigation end -->
          </div>
        @else
          <div class="col-lg-8 col-md-12">
            @foreach ($relatedPosts as $post)
              <x-post-card :blogPost="$post" :postDay="$post_day" :postMonth="$post_month" />
            @endforeach
          </div>
        @endif

        <!-- End list all posts -->

        <div class="col-lg-4 col-md-12">
          <x-blog-sidebar :commonTags="$commonTags" />
        </div>
      </div>
    </div>
  </div>
  <!-- Blog body end -->
@endsection
