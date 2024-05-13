@extends("user.admin-dashboard")

@section("content")
  <div class="dashboard-content">
    <div class="dashboard-list">
      <h4>Bookmark Property</h4>
      <div class="my-property">
        <table class="manage-table mb-30">
          <tbody class="responsive-table">
            <tr>
              <td class="listing-photoo">
                <img src="" alt="property-img" class="img-fluid">
              </td>
              <td class="title-container">
                <h5><a href="#">Real Luxury Villa</a></h5>
                <p><i class="flaticon-pin"></i> 123 Kathal St. Tampa City, </p>
                <h6><span>$90.00</span> / monthly</h6>
              </td>
              <td class="date"></td>
              <td class="action">
                <ul>
                  <li>
                    <a href="#" class="delete delete dlt"><i class="fa fa-remove"></i> Delete</a>
                  </li>
                </ul>
              </td>
            </tr>
            <tr class="">
              <td class="listing-photoo">
                <img src="" alt="property-img" class="img-fluid">
              </td>
              <td class="title-container">
                <h5><a href="#">Relaxing Apartment</a></h5>
                <p><i class="flaticon-pin"></i> 123 Kathal St. Tampa City, </p>
                <h6><span>$90.00</span> / monthly</h6>
              </td>
              <td class="date"></td>
              <td class="action">
                <ul>
                  <li>
                    <a href="#" class="delete dlt"><i class="fa fa-remove"></i> Delete</a>
                  </li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
