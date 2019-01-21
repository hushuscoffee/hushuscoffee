<!doctype html>
<html lang="en">
@include('partials._head')
<body>
  @include('partials._messages')
  @yield('content')
  @include('partials._footer')
  @yield('scripts')
</body>
</html>
