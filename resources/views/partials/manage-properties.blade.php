@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4 class="bg-grea-3">My Properties List</h4>
      <div class="row pad-20">
        @if ($props->isEmpty())
          <div class="container">
            <h6>No Properties.
              <a href="/submit-property" type="button" class="btn-theme pull-right rounded">
                <i class="lnr lnr-plus-circle"></i>
                Upload Property
              </a>
            </h6>
          </div>
        @else
          <table class="manage-table">
            {{ $props->links("vendor.pagination.bootstrap-4") }}
            <tbody class="responsive-table">
              @foreach ($props as $prop)
                <tr>
                  <td class="listing-photoo">
                    <img src="{{ asset("storage/uploads/ft_images/" . $prop->ft_image) }}" alt="listing-photo"
                      class="img-fluid">
                  </td>
                  <td class="title-container">
                    <h5><a href="{{ route("single.prop", $prop->id) }}">{{ $prop->title }}</a></h5>
                    <p><i class="flaticon-pin"></i> {{ $prop->location }} </p>
                    <h6 class="table-property-price">
                      {{ $prop->currency }} {{ $prop->price }}
                      @php
                        $offertype = in_array($prop->offer_type, ["rent", "lease"]);
                      @endphp
                      {{ $offertype ? "/month" : "" }}
                    </h6>
                  </td>
                  <td class="expire-date"></td>
                  <td class="action">
                    <ul>
                      <li><a href="/property/{{ $prop->id }}/edit"><i class="fa fa-pencil"></i> Edit</a></li>
                      <li>
                        <a href="javascript(void)" class="delete-btn" data-id="{{ $prop->id }}" data-bs-toggle="modal"
                          data-bs-target="#confirmPropDelModal"><i class="fa fa-remove"></i>
                          Delete
                        </a>
                      </li>
                      {{-- <li><a href="#"><i class="fa  fa-eye-slash"></i> Hide</a></li> --}}
                    </ul>

                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      </div>
      {{ $props->links("vendor.pagination.bootstrap-4") }}
    </div>
  </div>

  {{-- Modal Prompt to confirm delete Property --}}
  <div class="modal fade" id="confirmPropDelModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
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
            <p> Are you sure you want to permanently delete this property and its related data?
              <br><span class="text-danger">This action is not reversible.</span>
            </p>

            <br>
            <button class="btn btn-danger delete" type="submit">
              <i class="fa fa-trash"></i> Delete Property
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push("scripts")
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const deleteButtons = document.querySelectorAll('.delete-btn');
      const deleteForm = document.getElementById('deleteForm');

      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const propertyId = this.dataset.id;
          deleteForm.action = `/property/${propertyId}`;
        });
      });
    });
  </script>
@endpush
