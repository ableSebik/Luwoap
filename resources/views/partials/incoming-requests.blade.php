@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4>Clients Requests</h4>

      <div class="row pad-20">
        <div class="tabbing tabbing-box mb-50">
          <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item " role="presentation">
              <button class="nav-link active" id="all-requests-tab" data-bs-toggle="tab" data-bs-target="#all-requests"
                type="button" role="tab" aria-controls="home" aria-selected="true">All Requests</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                role="tab" aria-controls="home" aria-selected="true">New Requests</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                role="tab" aria-controls="profile" aria-selected="false">Attended</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                role="tab" aria-controls="contact" aria-selected="false">Archived</button>
            </li>
          </ul>
          <hr>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="all-requests" role="tabpanel" aria-labelledby="all-requests-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample3">
                <div class="accordion-item">
                  <p>All req.</p>
                </div>
              </div>
              {{ $requests->links("vendor.pagination.bootstrap-4") }}
            </div>
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample7">
                <div class="accordion-item">
                  <div class="col-lg-12">
                    @forelse ($requests as $clientRequest)
                      <div class="comment-meta clearfix">
                        <h6 class="text-capitalize pull-left">
                          <a href="javascript::(void)" class="delete-btn" data-bs-toggle="modal"
                            data-bs-target="#reqModal" data-name="{{ $clientRequest->name }}"
                            data-phone="{{ $clientRequest->phone }}" data-email="{{ $clientRequest->email }}"
                            data-status="{{ $clientRequest->status }}" data-message="{{ $clientRequest->message }}"
                            data-prop-id="{{ $clientRequest->prop_id }}"
                            data-created-at="{{ $clientRequest->created_at->format("g:i A n/j/Y") }}"
                            data-hr-since="{{ $clientRequest->hrSinceCreation }}"
                            data-days-since="{{ $clientRequest->daysSinceCreation }}">
                            {{ $clientRequest->name }}
                          </a>

                        </h6>
                        <div class="comment-meta pull-right">
                          <a class="mr-2" target="_blank"
                            href="{{ route("single.prop", $clientRequest->prop_id) }}">View
                            Property</a>
                          @if ($clientRequest->hrSinceCreation < 24)
                            {{ $clientRequest->hrSinceCreation }} hrs ago.
                          @elseif ($clientRequest->daysSinceCreation <= 3)
                            {{ $clientRequest->daysSinceCreation }} days ago.
                          @else
                            {{ $clientRequest->created_at->format("g:i A n/j/Y") }}
                          @endif
                        </div>
                      </div>
                      <hr>

                    @empty
                      <p>No Requests</p>
                    @endforelse

                  </div>
                </div>
              </div>
              {{ $requests->links("vendor.pagination.bootstrap-4") }}
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample2">
                <div class="accordion-item">
                  <p>sec.</p>
                </div>
              </div>
              {{ $requests->links("vendor.pagination.bootstrap-4") }}
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
              <div class="accordion accordion-flush" id="accordionFlushExample3">
                <div class="accordion-item">
                  <p>3rd.</p>
                </div>
              </div>
              {{ $requests->links("vendor.pagination.bootstrap-4") }}
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

  {{-- Modal Prompt with Request Details --}}
  <div class="modal fade" id="reqModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
  </div>
@endsection

@push("scripts")
  <script>
    $(document).ready(function() {
      $('#reqModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var phone = button.data('phone');
        var email = button.data('email');
        var status = button.data('status');
        var message = button.data('message');
        var propId = button.data('prop-id');
        var createdAt = button.data('created-at');
        var hrSince = button.data('hr-since');
        var daysSince = button.data('days-since');

        var modal = $(this);
        modal.find('#modalClientName').text(name);
        modal.find('#modalClientPhone').text(phone);
        modal.find('#modalClientEmail').text(email).data('prop-id',
          propId); // Attach prop-id to email field for identification
        modal.find('#modalClientStatus').text(status);
        modal.find('#modalClientMessage').text(message);
        modal.find('#modalViewProperty').attr('href', '/props/prop-details/' + propId);
        if (hrSince < 24) {
          modal.find('#modalTimeSince').text(hrSince + ' hrs ago.');
        } else if (daysSince <= 3) {
          modal.find('#modalTimeSince').text(daysSince + ' days ago.');
        } else {
          modal.find('#modalTimeSince').text(createdAt);
        }
      });

      $('.status-option').on('click', function(event) {
        event.preventDefault();

        var status = $(this).data('status');
        var requestId = $('#modalClientEmail').data('prop-id'); // Get the prop-id from the email field
        var form = $('#update-status-form');
        var actionUrl = '/requests/' + requestId + '/status';

        form.attr('action', actionUrl);

        $.ajax({
          url: actionUrl,
          type: 'POST',
          data: {
            _token: $('input[name=_token]').val(),
            status: status
          },
          success: function(response) {
            if (response.success) {
              alert(response.message);
              $('#reqModal').modal('hide');
              location.reload();
            } else {
              alert('Failed to update status.');
            }
          },
          error: function(xhr) {
            alert('An error occurred. Please try again.');
          }
        });
      });
    });
  </script>
@endpush
