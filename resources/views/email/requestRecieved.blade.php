<!DOCTYPE html>
<html>

  <head>
    <title>Thank You for Your Enquiry</title>
  </head>

  <body>
    <p>Dear {{ $clientName }},</p>
    <p>Thank you for your enquiry for <a href="{{ route("single.prop", $prop_id) }}">this property</a>. An agent will
      contact
      you
      shortly.</p>
    <p></p>
  </body>

</html>
