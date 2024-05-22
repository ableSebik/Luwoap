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
              <img src="{{ asset("storage/Posts/" . $postDetails->post_ft_image) }}" alt="blog-img"
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
                      <a href="{{ route("posts.byTag", ["tag" => $tag]) }}">{{ $tag }}</a>
                    @endforeach

                  </div>
                </div>
                {{-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="blog-social-list">
                    <span>Share</span>
                    <a href="#" class="facebook-bg">
                      <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#" class="twitter-bg">
                      <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#" class="google-bg">
                      <i class="fa fa-google"></i>
                    </a>
                    <a href="#" class="linkedin-bg">
                      <i class="fa fa-linkedin"></i>
                    </a>
                    <a href="#" class="pinterest-bg">
                      <i class="fa fa-pinterest"></i>
                    </a>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
          {{-- <!-- Heading 2 -->
          <h3 class="heading-2">Comments Section</h3>
          <!-- Comments start -->
          <ul class="comments">
            <li>
              <div class="comment">
                <div class="comment-author">
                  <a href="#">
                    <img src="img/avatar/avatar-1.jpg" alt="comments-user">
                  </a>
                </div>
                <div class="comment-content">
                  <div class="comment-meta">
                    <h3>
                      Maikel Alisa
                    </h3>
                    <div class="comment-meta">
                      8:42 PM 1/28/2022<a href="#">Reply</a>
                    </div>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam
                    gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,
                    dapibus tempus nulla.</p>
                </div>
              </div>
              <ul>
                <li>
                  <div class="comment">
                    <div class="comment-author">
                      <a href="#">
                        <img src="img/avatar/avatar-2.jpg" alt="comments-user">
                      </a>
                    </div>
                    <div class="comment-content">
                      <div class="comment-meta">
                        <h3>
                          Brady Anne
                        </h3>
                        <div class="comment-meta">
                          8:42 PM 1/28/2022<a href="#">Reply</a>
                        </div>
                      </div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam
                        gravida massa at sem vulputate interdum et vel eros.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li>
              <div class="comment">
                <div class="comment-author">
                  <a href="#">
                    <img src="img/avatar/avatar-3.jpg" alt="comments-user">
                  </a>
                </div>
                <div class="comment-content">
                  <div class="comment-meta">
                    <h3>
                      Anne Brady
                    </h3>
                    <div class="comment-meta">
                      8:42 PM 1/28/2022<a href="#">Reply</a>
                    </div>
                  </div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam
                    gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,
                    dapibus tempus nulla.</p>
                </div>
              </div>
              <ul>
                <li>
                  <div class="comment">
                    <div class="comment-author">
                      <a href="#">
                        <img src="img/avatar/avatar-4.jpg" alt="comments-user">
                      </a>
                    </div>
                    <div class="comment-content mrg-bdr">
                      <div class="comment-meta">
                        <h3>
                          Jane Doe
                        </h3>
                        <div class="comment-meta">
                          8:42 PM 1/28/2022<a href="#">Reply</a>
                        </div>
                      </div>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam
                        gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,
                        dapibus tempus nulla.</p>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
          <!-- Contact 2 start -->
          <div class="contact-2 mb-30">
            <h3 class="heading-2">Contact Form</h3>
            <form action="#" method="GET" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group name">
                    <input type="text" name="name" class="form-control" placeholder="Name" aria-label="Full Name">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group email">
                    <input type="email" name="email" class="form-control" placeholder="Email Address"
                      aria-label="Email Address">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group subject">
                    <input type="text" name="subject" class="form-control" placeholder="Subject"
                      aria-label="Subject">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group number">
                    <input type="text" name="phone" class="form-control" placeholder="Phone"
                      aria-label="Phone Number">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group message">
                    <textarea class="form-control" name="message" placeholder="Write message" aria-label="Write message"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="send-btn">
                    <button type="submit" class="btn-6">Send Message</button>
                  </div>
                </div>
              </div>
            </form>
          </div> --}}
        </div>
        <div class="col-lg-4 col-md-12">
          <x-blog-sidebar :commonTags="$commonTags" />
        </div>
      </div>
    </div>
  </div>
  <!-- Blog body end -->
@endsection
