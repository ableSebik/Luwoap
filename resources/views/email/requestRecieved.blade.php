<!DOCTYPE html>
<html>

  <head>
    <title>Thank You for Your Enquiry</title>
  </head>

  <body>
    <div class="mail-container">
      <div class="logo">
        <a href="/">
          <img src="{{ asset("assets/img/logos/luwoap-dark.png") }}" alt="logo">
        </a>
      </div>

      <div class="mail-body">
        <p>Dear {{ $clientName }},</p>
        <p>Thank you for your enquiry for <a href="{{ route("single.prop", $prop_id) }}">this property</a>. An agent will
          contact you shortly.</p>
        <p></p>
      </div>

      <div class="mail-footer">

      </div>
    </div>
  </body>

</html>
