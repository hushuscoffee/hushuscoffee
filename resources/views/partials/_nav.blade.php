<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">HushusCoffee</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 mr-auto">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item dropdown {{ Request::is('article/*') ? "active" : "" }}">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          Article
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('events')}}">Events</a>
          <a class="dropdown-item" href="{{route('news')}}">News</a>
          <a class="dropdown-item" href="{{route('tips')}}">Tips</a>
        </div>
      </li>
      <li class="nav-item {{ Request::is('brewing') ? "active" : "" }}">
        <a class="nav-link" href="#">Brewing Method</a>
      </li>
      <li class="nav-item {{ Request::is('recipe') ? "active" : "" }}">
        <a class="nav-link" href="#">Recipe</a>
      </li>
      <li class="nav-item {{ Request::is('people') ? "active" : "" }}">
        <a class="nav-link" href="#">People</a>
      </li>
      @if(Auth::check())
      <li class="nav-item dropdown {{ Request::is('note','note/*') ? "active" : "" }}">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false">
          @if(Auth::user()->role_id==1)
            <i class="fa d-inline fa-md fa-user"></i> Admin
          @else
            <i class="fa d-inline fa-md fa-user"></i> User
          @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('note')}}">My Note</a>
          <a class="dropdown-item" href="{{route('profile')}}"><i class="fa fa-gear"></i> Profile</a>
          <a class="dropdown-item" href="{{route('getLogout')}}"><i class="fa fa-power-off"></i>Log Out</a>
        </div>
      </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{route('getRegister')}}"><i class="fa d-inline fa-md fa-user-plus"></i> Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('getLogin')}}"><i class="fa d-inline fa-lg fa-user-circle"></i> Login</a>
      </li>
      @endif
    </ul>
  </div>
</nav>