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
          <table class="manage-table table table-responsive">
            {{ $props->links("vendor.pagination.bootstrap-4") }}
            <tbody class="responsive-table">
              @foreach ($props as $prop)
                <tr>
                  <td class="listing-photoo">
                    <img loading="lazy" src="{{ asset("storage/uploads/ft_images/" . $prop->ft_image) }}"
                      alt="{{ $prop->title }}" class="img-fluid">
                  </td>
                  <td class="title-container">
                    <h5><a href="{{ route("single.prop", $prop->slug) }}">{{ $prop->title }}</a>
                      <small>
                        @if ($prop->status == "live")
                          <i style="font-size: 12px" data-toggle="tooltip" data-placement="top" title="Live"
                            class="text-success fa fa-solid fa-circle"></i>
                        @else
                          <i style="font-size: 12px" data-toggle="tooltip" data-placement="top" title="Hidden"
                            class="fa fa-solid fa-circle"></i>
                        @endif
                      </small>
                    </h5>
                    <p><i class="flaticon-pin"></i> {{ $prop->location }} </p>
                    <h6 class="table-property-price">
                      @php
                        $price = "";
                        if ($prop->category == "hostel") {
                            $price = $prop->price_range;
                        } else {
                            $price = $prop->price;
                        }
                      @endphp
                      {{ $prop->currency }} {{ $price }}
                      @if (in_array($prop->offer_type, ["rent", "lease"]))
                        /{{ $prop->period }}
                      @endif
                    </h6>
                  </td>
                  <td class="expire-date"></td>
                  <td class="action">
                    <ul>
                      <li><a href="/property/{{ $prop->id }}/edit"><i class="fa fa-pencil"></i> Edit</a></li>
                      <li>
                        <a href="javascript::void(0)" class="status-btn" data-id="{{ $prop->id }}"
                          data-bs-toggle="modal" data-bs-target="#propertyStatusModal"><i class="fa  fa-eye-slash"></i>
                          Hide
                        </a>
                      </li>
                      <li>
                        <a href="javascript::void(0)" class="delete-btn" data-id="{{ $prop->id }}"
                          data-bs-toggle="modal" data-bs-target="#confirmPropDelModal"><i class="fa fa-remove"></i>
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

  {{-- Modal Prompt to confirm Change status of Property --}}
  <div class="modal fade" id="propertyStatusModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Property Status?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3" id="statusForm" method="POST">
            @csrf
            @method("PUT")
            <p>
              <span class="text-primary">Selecting "Hide" will make this property unavailable to
                users.</span>
            </p>
            <div class="col-md-6">
              <label for="status" class="visually-hidden">Status</label>
              <select class="selectpicker search-fields" name="status" id="status" required>
                <option value=""></option>
                <option value="live">Live</option>
                <option value="hidden">Hide</option>
              </select>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-primary mb-3">Confirm</button>
            </div>
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
      const statusBtn = document.querySelectorAll('.status-btn');
      const deleteForm = document.getElementById('deleteForm');
      const statusForm = document.getElementById('statusForm');

      deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
          const propertyId = this.dataset.id;
          deleteForm.action = `/property/${propertyId}`;
        });
      });

      statusBtn.forEach(button => {
        button.addEventListener('click', function() {
          const propertyId = this.dataset.id;
          statusForm.action = `/property/${propertyId}/status`;
        });
      });
    });
  </script>
@endpush
