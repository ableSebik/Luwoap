@foreach ($comments as $comment)
  <li>
    <div class="comment">
      <div class="comment-content">
        <div class="comment-meta">
          <h3>{{ $comment->user->name }}</h3>
        </div>
        <p>{{ $comment->comment }}</p>
        <div class="comment-meta">
          <i class="fas fa-comment-dots"></i>
          <a href="javascript:void(0)" onclick="reply(this)" data-parent-id="{{ $comment->id }}"
            class="reply-btn">Reply</a>
        </div>
        <div class="repliesDiv" style="display: none">
          <form action="{{ route("reply.store") }}" method="POST" id="replyForm">
            @csrf
            <input type="hidden" name="prop_id" value="{{ $singleProp->id }}">
            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="parent_id">
            <div class="form-group">
              <textarea id="reply-textarea" class="form-control" name="comment" placeholder="Write your reply"
                aria-label="Write message" maxlength="1000"></textarea>
              @error("comment")
                <p class="text-danger pull-left mb-4">{{ $message }}</p>
              @enderror
            </div>
            <div class="send-btn">
              <button type="submit" class="btn-6">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Replies -->
    @if ($comment->replies->count())
      <ul>
        @foreach ($comment->replies as $reply)
          <li>
            <div class="comment">
              <div class="comment-content">
                <div class="comment-meta">
                  <h3>{{ $reply->user->name }}</h3>
                </div>
                <p>{{ $reply->comment }}</p>
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    @endif
    <!-- End Replies -->
  </li>
@endforeach
