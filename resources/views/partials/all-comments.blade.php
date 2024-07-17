@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4>Manage Comments</h4>

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
                          <table class="table table-stripe manage-table">
                            {{ $comments->links("vendor.pagination.bootstrap-4") }}
                            <tbody class="responsive-table">
                              @foreach ($comments as $comment)
                                <tr>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <td>{{ $comment->comment }}</td>
                                    </div>
                                    <div class="col-md-2">
                                      <td class="action">
                                        <a href="#"><i class="fa fa-check"></i>
                                          Approve</a>
                                      </td>
                                    </div>
                                    <div class="col-md-2">
                                      <td class="action">
                                        <a href="javascript::void(0)" class="delete-btn" data-id=""
                                          data-bs-toggle="modal" data-bs-target="#confirmCommentpDelModal"><i
                                            class="fa fa-remove"></i>
                                          Delete
                                        </a>
                                      </td>
                                    </div>
                                    <div class="col-md-2">
                                      <td class="action">
                                        <a href="#"><i class="fa fa-hourglass-half" aria-hidden="true"></i>
                                          Pend</a>
                                      </td>
                                    </div>
                                  </div>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        @endif
                      </div>

                    </div>
                  </div>
                </div>
              </div>
              {{-- {{ $requests->links("vendor.pagination.bootstrap-4") }} --}}
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
              {{-- {{ $comments->links("vendor.pagination.bootstrap-4") }} --}}
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  {{-- Modal Prompt with Request Details --}}
  {{-- <div class="modal fade" id="reqModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Request Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-6">
                  <strong>Client Name:</strong>
                  <p id="modalClientName"></p>
                </div>
                <div class="col-md-6">
                  <strong>Phone:</strong>
                  <p id="modalClientPhone"></p>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-6">
                  <strong>Email:</strong>
                  <p id="modalClientEmail"></p>
                </div>
                <div class="col-md-6">
                  <strong>Status:</strong>
                  <p id="modalClientStatus"></p>
                </div>
              </div>
              <div class="row mb-2">
                <div class="col-md-12">
                  <strong>Message:</strong>
                  <p id="modalClientMessage"></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <p><a id="modalViewProperty" class="text-primary" target="_blank" href="#">View Property</a>
                  </p>
                </div>
                <div class="col-md-6">
                  <p id="modalTimeSince"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <h5 class="alert alert-warning w-100" style="text-transform: none!important">If you have contacted/addressed
              the
              client,
              update the status of the request
            </h5>
            <form id="update-status-form" method="POST" action="">
              @csrf
              <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  Update Status
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item status-option" href="#" data-status="new">New</a></li>
                  <li><a class="dropdown-item status-option" href="#" data-status="seen">Client Contacted</a>
                  </li>
                  <li><a class="dropdown-item status-option" href="#" data-status="archived">Archive</a></li>
                </ul>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div> --}}
@endsection

@push("scripts")
@endpush
