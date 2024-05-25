@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="submit-address dashboard-list advanced-search">
      <form method="GET">
        <h4>Bookings List</h4>
        <div class="row pad-20">
          <div class="col-lg-12">
            {{-- <div class="comment d-flex">
              <div class="comment-author">
                <a href="#">
                  <img src="img/avatar/avatar-1.jpg" alt="comments-user">
                </a>
              </div>
              <div class="comment-content">
                <div class="comment-meta">
                  <h5>Maikel Alisa</h5>
                  <div class="comment-meta">
                    8:42 PM 1/28/2022<a href="#">Reply</a>
                  </div>
                </div>
                <ul>
                  <li>Item :<span> Real Luxury Villa</span></li>
                  <li>Start date : <span> 18 November 2018</span></li>
                  <li>End date : <span> 18 November 2018</span></li>
                  <li>Booking details :<span> 4 Peoples</span></li>
                  <li>Mail : <span><a href="mailto:info@themevessel.com"> info@themevessel.com</a> </span></li>
                  <li>Phone : <span> <a href="tel:+79617036705">+79617036705</a></span></li>
                </ul>
                <div class="buttons mb-20">
                  <a href="#" class="btn-2 btn-gray"><i class="fa fa-fw fa-check-circle-o"></i> Approve</a>
                  <a href="#" class="btn-2 btn-gray"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
