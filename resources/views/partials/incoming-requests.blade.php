@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4>Clients Requests</h4>

      <div class="row pad-20">
        <div class="col-lg-12">

          @forelse ($requests as $clientRequest)
            <div class="">
              <div class="comment-meta clearfix">
                <h6 class="text-capitalize pull-left">
                  <a href="javascript(void)" class="delete-btn" data-bs-toggle="modal" data-bs-target="#reqModal"
                    data-name="{{ $clientRequest->name }}" data-phone="{{ $clientRequest->phone }}"
                    data-email="{{ $clientRequest->email }}" data-status="{{ $clientRequest->status }}"
                    data-message="{{ $clientRequest->message }}" data-prop-id="{{ $clientRequest->prop_id }}"
                    data-created-at="{{ $clientRequest->created_at->format("g:i A n/j/Y") }}"
                    data-hr-since="{{ $clientRequest->hrSinceCreation }}"
                    data-days-since="{{ $clientRequest->daysSinceCreation }}">
                    {{ $clientRequest->name }}
                  </a>

                </h6>
                <div class="comment-meta pull-right">
                  <a class="mr-2" target="_blank" href="{{ route("single.prop", $clientRequest->prop_id) }}">View
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
            </div>

          @empty
            <p>No Requests</p>
          @endforelse

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
            <div class="card-header">
              Client Details
            </div>
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
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <p><a id="modalViewProperty" class="text-primary" target="_blank" href="#">View Property</a></p>
                </div>
                <div class="col-md-6">
                  <p id="modalTimeSince"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary">Send Mail</button>
            <button class="btn btn-warning">Send SMS</button>
            <button class="btn btn-success">Update Status</button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push("scripts")
  <script>
    $('#reqModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // Button that triggered the modal
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
      modal.find('#modalClientEmail').text(email);
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
  </script>
@endpush
