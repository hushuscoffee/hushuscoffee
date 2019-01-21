@extends('main')
@section('title',' Change Photo Profile')

@section('stylesheets') 
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@include('partials._nav')

<div class="container">
    <div class="row container mt-3 justify-content-center">
        <div class="col col-md-offset-0 ml-3">
    	<div class="w3-card-2 w3-round w3-white">
        <div class="container col-md-10 mt-5">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link" href="{{route('profile.basic')}}"><span class="glyphicon glyphicon-list-alt"></span> Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('professional.accomplishments')}}"><span class="glyphicon glyphicon-tasks"></span> Accomplishments</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('professional.experience')}}"><span class="glyphicon glyphicon-blackboard"></span> Experience</a></li>            
                <li class="nav-item"><a class="nav-link" href="{{route('professional.skill')}}"><span class="glyphicon glyphicon-th-list"></span> Skill</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('avatar.change')}}"><span class="glyphicon glyphicon-th-list"></span> Change Photo Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('password.change')}}"><span class="glyphicon glyphicon-th-list"></span> Change Password</a></li>
            </ul> 
        </div>

        <div class="container">
            <div class="container">
                @if (session('info'))
                <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('info') }}
                </div>
                @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session('error') }}
                </div>
                @endif
            </div>

        <div class="container mt-3">
            <div class="col-md">
                <label>Change Photo Profile</label>

                <form class="w3-margin-top" method="POST" action="{{route('avatar.change.update')}}" enctype="multipart/form-data">           
                {{ csrf_field() }}   
                        <div class="form-group" style="font-size:11px">
                        <p>Change your photo profile here (.jpg, .jpeg, .png)</p>
                        <input type="file" style="font-size:11px" class="form-control" required name="photo">
                        @if ($errors->has('photo'))
                            <span class="help-block w3-red">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif
                        </div>                     
                        <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right mb-3">Save</button>
                    </div>
                </form>
        </div>
        </div>
        </div>
    </div>
</div>
@include('partials._javascript')
@endsection

