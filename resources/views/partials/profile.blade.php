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
                    <label>Your Title</label>
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
    <div class="row">
      <div class="col-md-12">
        <div class="dashboard-list">
          <h3 class="heading">Change Password</h3>
          <div class="dashboard-message contact-2">
            <form action="" method="GET">
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group name">
                    <label>Current Password</label>
                    <input type="password" name="current-password" class="form-control" placeholder="Current Password">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group email">
                    <label>New Password</label>
                    <input type="password" name="new-password" class="form-control" placeholder="New Password">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group subject">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm-new-password" class="form-control"
                      placeholder="Confirm New Password">
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="send-btn">
                    <button type="submit" class="btn btn-md button-theme">Change
                      Password</button>
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
