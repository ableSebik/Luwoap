<!-- Recent Blogs content -->
<div class="posts-by-category widget">
  <h3 class="sidebar-title">Recent Posts</h3>
  <div class="s-border"></div>
  <div class="m-border"></div>

  <div class="d-flex mb-3 recent-posts-box">
    <div class="detail align-self-center">
      <ul class="list-unstyled list-cat">
        @foreach ($recentPostsData["blogPosts"] as $recentBlogPost)
          <li>
            <a href="{{ route("postDetails.blog", $recentBlogPost->slug) }}">{{ $recentBlogPost->post_title }}</a>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
