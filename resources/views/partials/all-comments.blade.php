@extends("user.admin-dashboard")

<style>
  .comment-meta a {
    margin-left: 0 !important;
  }

  /* tr {
    align-items: end;
  } */
  /* .table>:not(caption)>*>* {
    border-bottom: none !important
  } */
</style>

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4>Manage Comments</h4>

      <div class="row container mtb-30">
        <div class="col-lg-12">
          <form method="GET" action="" class="form pull-right">
            <input type="text" name="search" value="{{ request("search") }}" placeholder="Search comments...">
            <button type="submit">Search</button>
          </form>
        </div>
      </div>
      <div class="row pad-20">
        <div class="tabbing tabbing-box mb-50">
          <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item " role="presentation">
              <button class="nav-link active" id="all-requests-tab" data-bs-toggle="tab" data-bs-target="#all-requests"
                type="button" role="tab" aria-controls="home" aria-selected="true">All Comments</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">Pending</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Approved</button>
            </li>
          </ul>
          <hr>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all-requests" role="tabpanel" aria-labelledby="all-requests-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample3">
                <div class="accordion-item">
                  <div class="col-lg-12">
                    <div class="comment-meta clearfix">

                      <div class="row pad-20">
                        @if ($comments->isEmpty())
                          <div class="container">
                            <h6>No Comments.
                            </h6>
                          </div>
                        @else
                          <table class="table">
                            <tbody>
                              @forelse ($comments as $comment)
                                <tr class="row">
                                  <td class="col-lg-6">
                                    @if ($comment->status == "approved")
                                      <i style="font-size: 12px" data-toggle="tooltip" data-placement="top" title="Live"
                                        class="text-success fa fa-solid fa-circle"></i>
                                    @else
                                      <i style="font-size: 12px" data-toggle="tooltip" data-placement="top" title="Hidden"
                                        class="fa fa-solid fa-circle text-danger"></i>
                                    @endif
                                    <a href="javascript::(void)" data-bs-toggle="modal" data-bs-target="#commentModal"
                                      data-id="{{ $comment->id }}" data-name="{{ $comment->user->name }}"
                                      data-phone="{{ $comment->user->phone }}" data-email="{{ $comment->user->email }}"
                                      data-status="{{ $comment->status }}" data-comment="{{ $comment->comment }}"
                                      data-prop-id="{{ $comment->prop_id }}"
                                      data-created-at="{{ $comment->created_at->format("g:i A n/j/Y") }}"
                                      data-hr-since="{{ $comment->hrSinceCreation }}"
                                      data-days-since="{{ $comment->daysSinceCreation }}">
                                      {{ $comment->user->name }}
                                    </a> <br>
                                    <span style="color: #7f7e7e">{{ $comment->comment }}</span>
                                  </td>

                                  <td class="col-lg-6 pull-right">
                                    <a href="javascript::void(0)" class="delete-btn text-danger"
                                      data-id="{{ $comment->id }}" data-bs-toggle="modal"
                                      data-bs-target="#confirmCommentDel"><i class="fa fa-trash"></i>
                                      Delete
                                    </a> |
                                    @if ($comment->hrSinceCreation < 24)
                                      {{ $comment->hrSinceCreation }} hrs ago.
                                    @elseif ($comment->daysSinceCreation <= 3)
                                      {{ $comment->daysSinceCreation }} days ago.
                                    @else
                                      {{ $comment->created_at->format("g:i A n/j/Y") }}
                                    @endif
                                  </td>

                                </tr>
                              @empty
                                <p>No Comments posted.</p>
                              @endforelse
                            </tbody>
                          </table>
                          {{ $comments->links("vendor.pagination.bootstrap-4") }}
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample7">
                <div class="accordion-item">
                  <div class="col-lg-12">
                    <div class="comment-meta clearfix">
                      <h6 class="text-capitalize pull-left">
                        Pending section
                      </h6>
                      <div class="comment-meta pull-right">
                      </div>
                    </div>
                    <hr>
                  </div>
                </div>
              </div>
              {{-- {{ $comments->links("vendor.pagination.bootstrap-4") }} --}}
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample2">
                <div class="accordion-item">
                  <div class="col-lg-12">
                    <div class="comment-meta clearfix">
                      <h6 class="text-capitalize pull-left">
                        Approved section
                      </h6>
                      <div class="comment-meta pull-right">
                      </div>
                    </div>
                    <hr>
                  </div>
                </div>
              </div>
              {{-- {{ $comments->links("vendor.pagination.bootstrap-4") }} --}}
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample3">
                <div class="accordion-item">
                  <p>3rd.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal Prompt to confirm delete comment --}}
  <div class="modal fade" id="confirmCommentDel" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="deleteForm" method="POST" class="form">
            @csrf
            @method("DELETE")
            <p> Are you sure you want to permanently delete this comment?
              <br><span class="text-danger">This action is not reversible.</span>
            </p>

            <br>
            <button class="btn btn-danger delete" type="submit">
              <i class="fa fa-trash"></i> Delete Comment
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Prompt to confirm Change status of comment --}}
  <div class="modal fade" id="commentModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comment Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-6">
                  Username:
                  <p id="modalClientName"></p>
                </div>
                <div class="col-md-6">
                  Phone:
                  <p id="modalClientPhone"></p>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  Email:
                  <p id="modalClientEmail"></p>
                </div>
                <div class="col-md-6">
                  Status:
                  <p id="modalClientStatus"></p>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-md-12">
                  Comment:
                  <p id="modalClientComment"></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p><a id="modalViewProperty" class="text-primary" target="_blank" href="#">See Property</a>
                  </p>
                </div>
                <div class="col-md-6">
                  <p id="modalTimeSince"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <form id="update-status-form" class="form form-inline" method="POST" action="">
              @csrf
              @method("PUT")
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Update Status
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item status-option" href="#" data-status="approved">Approve</a></li>
                  <li><a class="dropdown-item status-option" href="#" data-status="pending">Pend</a></li>
                </ul>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push("scripts")
  <script src="{{ asset("assets/js/comment-actions.js") }}"></script>
@endpush
