{{--  <div class="col-md-3 col-md-offset-1">
    <div class="w3-round w3-white">
        <div class="w3-container">
           <ul class="list-group list-group-flush">
            <li><a class="list-group-item" href="{{route('profile.basic')}}">basic info</a></li>            
            <li><a class="list-group-item" href="{{route('professional.profile')}}">professional profile</a></li>
            </ul>
        </div>
    </div>      
</div>  --}}

{{--  <ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link" href="{{route('profile.basic')}}">basic info</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('professional.profile')}}">professional profile</a>
    </li>
</ul>  --}}

<div class="list-group">
    <a href="{{route('profile.basic')}}" class="list-group-item list-group-item-action">basic info</a>
    <a href="{{route('professional.profile')}}" class="list-group-item list-group-item-action">professional profile</a>
</div>