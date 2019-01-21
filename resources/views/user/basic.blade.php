@extends('main')
@section('title',' Professional Profile')

@section('stylesheets') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
@endsection

@section('content')
@include('partials._nav')

<div class="container">
	{{--  <h3 class="mt-2">Profile Setting</h3>  --}}
    <div class="row container mt-3 justify-content-center">
    	{{--  @include('layout.sideprofilesetting')  --}}
        
    	<div class="col-md-10 col-md-offset-0">
    	<div class="w3-card-2 w3-round w3-white">
        <div class="container mt-5">
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

        {{--  Basic Profile Section  --}}

        <div class="container mt-3">
        <label>Basic Information</label>

        <form method="POST" action="{{route('profile.basic.update')}}" role="form">           
        {{ csrf_field() }}   
            <div class="form-group">
              <p>Full Name</p>
              <input type="text" class="form-control" name="fullname" value="{{$basic['fullname']}}" required>
            </div>         
            <div class="form-group">
              <p>Gender</p>
              <select class="form-control" id="gender" required name="gender">
                <option value="Male" @if ($basic['gender'] == "Male") {{ 'selected' }} @endif>Male</option>
                <option value="Female" @if ($basic['gender'] == "Female") {{ 'selected' }} @endif>Female</option>
              </select>
            </div>     
            <div class="form-group">
              <p>Email </p>
              <input type="email" class="form-control" name="emailreal" value="{{ $email }}" disabled>
            </div>              
            <div class="form-group">
              <p>Birthday</p>
              <input type="text" class="date form-control" id="birthday" name="birthday" value="{{ $basic['birthday'] }}">
            </div>              
            <div class="form-group">
              <p>Phone</p>
              <input type="tel" class="form-control" name="phone" value="{{$basic['phone']}}">
            </div>  
            <div class="form-group">
              <p>City</p>
              <input type="text" class="form-control" name="city" value="{{$basic['city']}}" required>
            </div>
            <div class="form-group">
              <p>Profession</p>
              <input type="text" class="form-control" name="profession" value="{{$basic['profession']}}" required>
            </div>
            <div class="form-group">
              <p>Website/Blog/Facebook/Twitter/Medium</p>
              <input type="text" class="form-control" name="sociallinks" value="{{$basic['sociallinks']}}">
            </div>          
            <div class="form-group">
              <p>Portfolio Link (LinkedIn/Docs)</p>
              <input type="text"class="form-control" name="portfoliolinks" value="{{$basic['portfoliolinks']}}">
            </div>
            <div class="form-group">
              <p>Address</p>
              <textarea rows="3" class="form-control" name="address" value="" required>{{$basic['address']}}</textarea>
            </div>
            <div class="form-group">
              <p>Tell Us About You</p>
              <textarea rows="3" class="form-control" name="aboutme" value="">{{$basic['aboutme']}}</textarea>
            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right mb-3">Save</button>
            </div>
        </form>
        </div>
        {{--  End Basic Profile Section  --}}
      
        </div>
        </div>
      </div>
  </div>
</div>
@include('partials._javascript')
@endsection

@section('scripts')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script type="text/javascript">
      $('#birthday').datepicker({
          autoclose: true,
      });
      $('#birthday').data("DateTimePicker").date("{{ $basic['birthday'] }}");
  </script>
@endsection
