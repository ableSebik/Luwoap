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
        <div class="col-lg-8 col-md-12">
          <!-- Blog 1 start -->
          @forelse ($blogPosts as $blogPost)
            <x-post-card :blogPost="$blogPost" />

          @empty
            <!-- Page navigation start -->
            <div class="pagination-box text-center">
              {{ $blogPosts->links("vendor.pagination.bootstrap-4") }}
            </div>
            <!-- Page navigation end -->
            <h5>No Post at this time.</h5>
          @endforelse
          <!-- Blog 1 end -->
        </div>
        <!-- End list all posts -->

        <div class="col-lg-4 col-md-12">
          <x-blog-sidebar :commonTags="$commonTags" />
        </div>
      </div>
    </div>
  </div>
  <!-- Blog body end -->
@endsection
