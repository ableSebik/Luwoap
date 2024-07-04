@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-header clearfix">
      <div class="row">
        <div class="col-sm-12 col-md-5">
          <h4>Edit Post</h4>
        </div>
      </div>
    </div>
    <div class="submit-address dashboard-list">
      <form id="create-post-form" method="POST" action="{{ route("post.update", $blog->id) }}" enctype="multipart/form-data">
        @csrf
        @method("put")

        <h4 class="bg-grea-3">Blog Information</h4>
        <div class="search-contents-sidebar">
          <div class="row pad-20">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="post_title">Post Title</label>
                <input type="text" id="post_title" name="post_title" class="form-control selectpicker search-fields"
                  placeholder=" Post Title" value="{{ $blog->post_title }}">
                @error("post_title")
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group">
                <label for="post_ft_image">Feature Image</label>
                <input type="file" name="post_ft_image" id="post_ft_image" class="form-control search-fields">

                <br>
                <img class="d-block w-50 rounded" src="{{ Storage::url("posts/" . $blog->post_ft_image) }}"
                  alt="{{ $blog->post_title }}">
                @error("post_ft_image")
                  <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>

          </div>
        </div>
        <h4 class="bg-grea-3">Content</h4>
        <div class="row pad-20">
          <div class="col-lg-12">
            <textarea class="input-text" name="post_content" id="update_post_content" placeholder="Detailed Information">{{ $blog->post_content }}</textarea>
            @error("post_content")
              <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <h4 class="bg-grea-3">Post Meta</h4>
        <div class="row pad-20">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
              <label for="post_excerpt">Excerpt <small>(30 WORDS MAX)</small></label>
              <input type="text" name="post_excerpt" value="{{ $blog->post_excerpt }}" id="post_excerpt"
                placeholder="What is this post about" class="form-control search-fields">
              @error("post_excerpt")
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group">
              <label for="post_tags">Tags</label>
              <input type="text" value="{{ $blog->post_tags }}" name="post_tags" id="post_tags"
                placeholder="Separate each tag with a coma (,)" class="form-control search-fields">
              @error("post_tags")
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <h4 class="bg-grea-3"></h4>
        <div class="row pad-20">
          <div class="col-lg-6 col-md-12 col-sm-12">
            <button class="btn btn-md button-theme" type="submit">Update and Publish Post</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push("scripts")
@endpush
