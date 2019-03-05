<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="_token" content="{{csrf_token()}}" />
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>HushusCoffee @yield('title')</title> <!-- CHANGE THIS TITLE FOR EACH PAGE -->
<link rel="icon" href="{{ asset('images/logo/logo.png')}}">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
    crossorigin="anonymous">
{{ Html::style('css/bootstrap.min.css') }}
{{ Html::style('css/styles.css') }}
{{ Html::style('css/custom_font.css') }}
@yield('stylesheets')