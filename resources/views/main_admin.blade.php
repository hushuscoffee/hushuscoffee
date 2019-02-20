<!doctype html>
<html lang="en">

<head>
  @include('partials._head')
</head>

<body>
  @include('partials._nav')

  <div class="container-fluid" style="margin-top: 55px;">
    <div id="wrapper" class="active">
      <!-- Sidebar -->
  @include('partials._leftbar')
      <!-- End of Sidebar -->
      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset" >
          <div class="row">
            <div class="col-md-12" style="margin-top: 10px;">
  @include('partials._messages') @yield('content')
            </div>
          </div>
        </div>
      </div>
  @include('partials._footer')
    </div>
  </div>
  <!-- end of .container -->
  @include('partials._javascript') @yield('scripts')

</body>

</html>