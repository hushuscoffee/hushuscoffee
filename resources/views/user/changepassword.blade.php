@extends('main')

@section('title',' Change Password')

@section('stylesheets')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@include('partials._nav')

<div class="container">
     <div class="row container mt-3 justify-content-center">
        <div class="col-md-10 col-md-offset-0">
            <div class="w3-card-2 w3-round w3-white">
                <div class="container mt-5">
                    <ul class="nav justify-content-center">
                        <li class="nav-item"><a class="nav-link" href="{{route('profile.basic')}}"><span class="glyphicon glyphicon-list-alt"></span> Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('professional.accomplishments')}}"><span class="glyphicon glyphicon-tasks"></span> Accomplishments</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('professional.experience')}}"><span class="glyphicon glyphicon-blackboard"></span> Experience</a></li>            
                        <li class="nav-item"><a class="nav-link" href="{{route('professional.skill')}}"><span class="glyphicon glyphicon-th-list"></span> Skill</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('password.change')}}"><span class="glyphicon glyphicon-th-list"></span> Change Photo Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('password.change')}}"><span class="glyphicon glyphicon-th-list"></span> Change Password</a></li>
                    </ul>
                </div>
            </div>
        </div>
     </div>

     <div class="container">
        @if (session('info'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;"><span aria-hidden="true">&times;</span></button>
                {{ session('info') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;"><span aria-hidden="true">&times;</span></button>
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="container mt-3 col-md-5 justify-content-center">
        <label>Change Password</label>
        <form class="w3-margin-top" method="POST" action="{{route('password.change.update')}}">
            {{ csrf_field() }}   
            <div class="form-group">
                <p>Old Password</p>
                <input type="password" class="form-control" required name="old" value="{{ old('old') }}" minlength="8">
            </div>       
            <div class="form-group">
                <p>New Password</p>
                <input type="password" class="form-control" min="8" max="12" required name="password" value="{{ old('password') }}" minlength="8">
            </div>             
            <div class="form-group">
                <p>Re-Type Password</p>
                <input type="password" class="form-control" min="8" max="12" required name="mtchpwd" value="{{ old('mtchpwd') }}" minlength="8">
            </div>             
                <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right mb-3">Save</button>
            </div>
        </form>
    </div>
</div>
<br><br><br><br><br>
@include('partials._javascript')
@section('scripts')
@endsection
@endsection
