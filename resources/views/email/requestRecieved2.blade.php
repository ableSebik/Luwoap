<!DOCTYPE html>
<html>

  <head>
    <title>Thank You for Your Enquiry</title>
  </head>

  <body>
    <div class="mail-container">
      <div class="logo">
        <a href="/">
          <img loading="lazy" src="{{ asset("assets/img/logos/luwoap-dark.png") }}" alt="logo">
        </a>
      </div>

      <div class="mail-body">
        <p>Dear {{ $clientName }},</p>
        <p>Thank you for your enquiry for <a href="/">this property</a>.</p>
        <p>We will contact you shortly.</p>
      </div>

      <div class="mail-footer">

      </div>
    </div>
  </body>

</html>
