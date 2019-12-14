<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    @if (Session::has('notification'))
      <script>
      alert();
      </script>
      {{ Session::get('notification')['message']}}
      <br>
      {{ Session::get('notification')['alert-type']}}
        <br>
        {{Session::forget('notification')}}
        <br>
        {{ Session::get('notification')['message']}}
        <br>
          {{ Session::get('notification')['alert-type']}}
    @endif

  </body>
</html>
