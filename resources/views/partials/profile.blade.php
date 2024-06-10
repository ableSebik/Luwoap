@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4>My Account</h4>
      <div class="dashboard-message contact-2 bdr clearfix">
        <div class="row">
          <div class="col-lg-12">
            <form action="#" method="GET" enctype="multipart/form-data">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                  <div class="form-group name">
                    <label>Your Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" disabled class="form-control"
                      placeholder="John Deo">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-group email">
                    <label>Role</label>
                    <input type="text" name="title" disabled value="{{ Auth::user()->role }}" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-group subject">
                    <label>Phone</label>
                    <input type="text" name="phone" disabled value="{{ Auth::user()->phone }}" class="form-control"
                      placeholder="01737 133959">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6">
                  <div class="form-group number">
                    <label>Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" name="email" disabled class="form-control"
                      placeholder="abc@gmail.com">
                  </div>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
