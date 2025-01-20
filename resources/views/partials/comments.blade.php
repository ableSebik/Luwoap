@foreach ($comments as $comment)
  <li>
    <div class="comment">
      <div class="comment-content">
        <div class="comment-meta">
          <h5>{{ $comment->user->name }}</h5>
        </div>
        <p style="margin-bottom:0px ">{{ $comment->comment }}</p>
        <div class="comment-meta">
          @auth
            <a href="javascript:void(0)" onclick="reply(this)" data-parent-id="{{ $comment->id }}" class="reply-btn">Reply
            </a>
          @endauth

          @php
            $approvedReplies = $comment->replies->where("status", "approved");
          @endphp

          @if ($approvedReplies->count())
            <a href="javascript:void(0)" onclick="viewReplies(this)" data-bs-toggle="modal"
              data-bs-target="#staticBackdrop" data-parent-id="{{ $comment->id }}" class="reply-btn">&nbsp;
              - View {{ $approvedReplies->count() }} replies</a>
          @endif
        </div>
        @auth
          <div class="repliesDiv comment-section" style="display: none">
            <form action="{{ route("reply.store") }}" method="POST" id="replyForm" class="form-inline d-flex">
              @csrf
              <input type="hidden" name="prop_id" value="{{ $singleProp->id }}">
              <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
              <input type="hidden" name="parent_id">
              <input id="reply-textarea" class="form-control" name="comment" placeholder="Add your reply"
                aria-label="Write message"></input>
              <button type="submit" class="btn">Submit</button>
            </form>
          </div>
        @endauth
      </div>
    </div>
  </li>
@endforeach
