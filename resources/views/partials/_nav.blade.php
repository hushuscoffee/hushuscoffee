<header class="header-area">
<nav class="navbar navbar-expand-md bg-primary navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="{{route('index')}}">
      {{-- <i class="fa d-inline fa-lg fa-coffee"></i>
      <b> Coffee Story</b> --}} 
    <img src="{{asset('images/logo/hushus_coffee.png')}}" width="180px"/>
    </a>
<form action="{{url('/search')}}">
<div class="row">
  <div class="col-md"> 
    <label class="sr-only" for="search">Search</label>
    <div class="input-group">
        <input type="text" name="search" placeholder="Search" id="search" class="form-control"/>
        <div class="input-group-append">
          <div class="input-group-text">
            <i class="fa fa-search"></i>
          </div>
      </div>
    </div>
  </div>
</div>
</form>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-center justify-content-end" id="navbar2SupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('brewing')}}">
            {{-- <i class="fa d-inline fa-lg fa-book"></i> Brewing Method</a> --}}
            Brewing Method</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('recipe')}}">
            {{-- <i class="fa d-inline fa-lg fa-book"></i> Recipe</a> --}}
            Recipe</a>
        </li>
        <li>
          <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle underline" data-toggle="dropdown">Article </button>
          <div class="dropdown-menu">
            <a class="nav-link" href="{{route('news')}}">News</a>
            <a class="nav-link" href="{{route('tips')}}">Tips</a>
            <a class="nav-link" href="{{route('event')}}">Events</a>
          </div>
        </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('people')}}">
            People</a>
        </li>
      </ul>
      <br>
      @if(Auth::check())
        <div class="btn-group">
          <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa d-inline fa-lg fa-user-circle-o"></i> Hi, {{ Auth::user()->username }} </button>
          <div class="dropdown-menu">
            @if(Auth::user()->id_role==1)
              <a class="nav-link" href="{{route('admin')}}"><i class="fa fa-user-secret"></i> Admin</a>
            @endif
            <a class="nav-link" href="{{route('personalize')}}"><i class="fa fa-dashboard"></i> Personalize</a>
            <a class="nav-link" href="{{route('profile.basic')}}"><i class="fa fa-gear"></i> Profile</a>
            <a class="nav-link" href="{{route('favorite.index')}}"><i class="fa fa-heart"></i> Favorites</a>
            <a class="nav-link" href="{{route('logout')}}"><i class="fa fa-power-off"></i> Log Out</a>
          </div>
      @else
      {{-- <a class="btn ml-2 text-white btn-primary" href="{{route('register')}}">
        <i class="fa d-inline fa-lg fa-user-plus"></i> Register</a>
      <a class="btn ml-2 text-white btn-primary" href="{{route('login')}}">
        <i class="fa d-inline fa-lg fa-user-circle-o"></i> Sign in</a> --}}
        <button type="button" onclick="window.location='{{ route('register') }}'" class="btn btn-primary text-white"><i class="fa d-inline fa-lg fa-user-plus"></i> Register </button>
        <button type="button" onclick="window.location='{{ route('login') }}'" class="btn btn-primary text-white"><i class="fa d-inline fa-lg fa-user-circle-o"></i> Login </button> 
      @endif
    </div>
  </div>
</nav>
</header>
@include('partials._messages')