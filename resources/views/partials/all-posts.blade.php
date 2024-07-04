@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4 class="bg-grea-3">Posts List</h4>
      <div class="row pad-20">
        @if ($posts->isEmpty())
          <div class="container">
            <h6>No Posts Published.
              <a href="/create-post" type="button" class="btn-theme pull-right rounded">
                <i class="lnr lnr-plus-circle"></i>
                Publish a Post
              </a>
            </h6>
          </div>
        @else
          <div class="container">
            <table class="table table-borderless mb-0">
              <tbody>
                <tr>
                  <td scope="col">Title</td>
                  <td scope="col">Edit</td>
                  <td scope="col">Delete</td>
                </tr>
                @forelse ($posts as $blog)
                  <tr>
                    <td>
                      <p><a href="{{ route("postDetails.blog", $blog->id) }}">{{ $blog->post_title }}</a></p>
                    </td>
                    <td>
                      <a type="button" class="btn btn-success btn-sm rounded" href="/post/{{ $blog->id }}/edit">
                        <i class="lnr lnr-pencil"></i> Edit
                      </a>
                    </td>
                    <td><a href="javascript::void(0)" class="btn btn-danger btn-sm rounded" data-id="{{ $blog->id }}"
                        data-bs-toggle="modal" data-bs-target="#confirmPostDelModal"> <i class="lnr lnr-trash"></i>
                        Delete</a></td>
                  </tr>
                @empty
                  <tr>
                    <td>No Post</td>
                    <td></td>
                    <td></td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            {{ $posts->links("vendor.pagination.bootstrap-4") }}
          </div>
          {{-- <table class="manage-table">
            <tbody class="responsive-table">
              @foreach ($posts as $blog)
                <tr class="row">
                  <td class="listing-photoo">
                    <img src="{{ asset("storage/posts/" . $blog->post_ft_image) }}" alt="{{ $blog->post_title }}"
                      class="img-fluid">
                  </td>
                  <td class="title-container col-md-8">
                    <h5><a href="{{ route("postDetails.blog", $blog->id) }}">{{ $blog->post_title }}</a></h5>
                  </td>
                  <td class="action col-md-4">
                    <ul>
                      <li>
                        <a href="/post/{{ $blog->id }}/edit"><i class="fa fa-pencil"></i> Edit</a>
                      </li>
                      <li>
                        <a href="javascript::void(0)" class="delete-btn" data-id="{{ $blog->id }}" data-bs-toggle="modal"
                          data-bs-target="#confirmPostDelModal"><i class="fa fa-remove"></i> Delete</a>
                      </li>
                    </ul>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table> --}}
        @endif
      </div>

    </div>
  </div>
  {{-- Modal Prompt to confirm delete Post --}}
  <div class="modal fade" id="confirmPostDelModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
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
            <p>Are you sure you want to permanently delete this Post?<br>
              <span class="text-danger">This action is not reversible.</span>
            </p>

            <br>
            <button class="btn btn-danger delete" type="submit">
              <i class="fa fa-trash"></i> Delete Post
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
          const postId = this.dataset.id;
          deleteForm.action = `/post/${postId}`;
        });
      });
    });
  </script>
@endpush
