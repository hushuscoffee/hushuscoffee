<!doctype html>
<html lang="en">
<head>
  @include('partials._head')
</head>

<body>
  @include('partials._nav')

  <div class="container" style="margin-top: 80px;">
  @include('partials._messages') @yield('content')
  @include('partials._footer')

  </div>
  <!-- end of .container -->
</body>
@include('partials._javascript') @yield('scripts')
</html>