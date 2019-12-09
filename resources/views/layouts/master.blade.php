<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <title> @yield('title') </title>
  <!-- <link rel="shortcut icon" href="assets/images/favicon.ico" /> -->
  @yield('stylesheets')
  @include('layouts.header')
  @include('layouts.nav')
</head>
<body>

  @yield('content')

@include('layouts.footer')
  <!-- end main-wrapper -->
@yield('secripts')
</body>
</html>
