@extends('main')
@section('title',' Professional Profile')

@section('stylesheets') 
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@include('partials._nav')

<div class="container">
	<h3 class="mt-2">Profile Setting</h3>
    <div class="row container">
      {{--  @include('layout.sideprofilesetting')  --}}
      
    	<div class="col col-md-offset-0 ml-3">
    	<div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
        <ul class="nav justify-content-center" style="font-size:13px; color:grey">
            <li class="nav-item"><a class="nav-link" href="{{route('professional.profile')}}"><span class="glyphicon glyphicon-list-alt"></span> Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('professional.accomplishments')}}"><span class="glyphicon glyphicon-tasks"></span> Accomplishments</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('professional.experience')}}"><span class="glyphicon glyphicon-blackboard"></span> Experience</a></li>            
            <li class="nav-item"><a class="nav-link" href="{{route('professional.skill')}}"><span class="glyphicon glyphicon-th-list"></span> Skill</a></li>
        </ul>
        </div>
        
        <div class="w3-container">
        <label>Profile</label>
        @if (session('info'))
          <div class="alert alert-info alert-dismissible" role="alert" style="font-size: 13px">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;"><span aria-hidden="true">&times;</span></button>
              {{ session('info') }}
          </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert" style="font-size: 13px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;"><span aria-hidden="true">&times;</span></button>
                {{ session('error') }}
            </div>
        @endif

        @if($proprofile!=null)
        <form class="w3-margin-top" method="POST" action="{{route('professional.profile.update')}}" enctype="multipart/form-data">           
        {{ csrf_field() }}   
                <div class="form-group" style="font-size:11px">
                  <p>Where is the city you live at this time?</p>
                  <input type="text" style="font-size:11px" class="form-control" required name="city" value="{{$proprofile->city}}">
                </div>
                <div class="form-group" style="font-size:11px">
                  <p>What is your job at this time?</p>
                  <input type="text" style="font-size:11px" class="form-control" required name="job" value="{{$proprofile->job}}">
                </div>     
                <div class="form-group" style="font-size:11px">
                  <p>Linkedin</p>                  
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-linkedin"></i>
                  </div>
                  <input type="text" style="font-size:11px" class="form-control" required name="linkedin" placeholder="https://www.linkedin.com/in/username" value="{{$proprofile->linkedin}}">
                </div>                
                </div>
                <div class="form-group" style="font-size:11px">
                  <p>Upload your new resume/CV (.doc, .docx, or .pdf)</p>
                  <input type="file" style="font-size:11px" class="form-control" name="resume">
                  <p>Your current resume <a class="w3-blue w3-btn" href="{{asset('resume/'. $proprofile->resume)}}" target="_blank">download here</a></p>
                  @if ($errors->has('resume'))
                      <span class="help-block w3-red">
                          <strong>{{ $errors->first('resume') }}</strong>
                      </span>
                  @endif
                </div>     
                <div class="form-group" style="font-size:11px">
                  <p>Summary about yourself</p>
                  <textarea class="form-control" rows="5" name="summary" required>{{$proprofile->summary}}</textarea>
                </div>     
                 <div class="box-footer">
                <input type="submit" class="w3-btn w3-green" value="Save"/>
              </div>
        </form>
        @else
        <form class="w3-margin-top" method="POST" action="{{route('professional.profile.update')}}" enctype="multipart/form-data">           
        {{ csrf_field() }}   
                <div class="form-group" style="font-size:11px">
                  <p>Where is the city you live at this time?</p>
                  <input type="text" style="font-size:11px" class="form-control" required name="city" value="{{ old('city') }}">
                </div>
                <div class="form-group" style="font-size:11px">
                  <p>What is your job at this time?</p>
                  <input type="text" style="font-size:11px" class="form-control" required name="job" value="{{ old('job') }}">
                </div>     
                <div class="form-group" style="font-size:11px">
                  <p>Linkedin</p>                  
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-linkedin"></i>
                  </div>
                  <input type="text" style="font-size:11px" class="form-control" required name="linkedin" placeholder="https://www.linkedin.com/in/username" value="{{ old('linkedin') }}">
                </div>                
                </div>
                <div class="form-group" style="font-size:11px">
                  <p>Upload your new resume/CV (.doc, .docx, or .pdf)</p>
                  <input type="file" style="font-size:11px" class="form-control" required name="resume">
                  @if ($errors->has('resume'))
                                    <span class="help-block w3-red">
                                        <strong>{{ $errors->first('resume') }}</strong>
                                    </span>
                                @endif
                </div>     
                <div class="form-group" style="font-size:11px">
                  <p>Summary about yourself</p>
                  <textarea class="form-control" rows="5" name="summary" required>{{ old('summary') }}</textarea>
                </div>     
                 <div class="box-footer">
                <input type="submit" class="w3-btn w3-green" value="Save"/>
              </div>
        </form>
        @endif
        </div>
        </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@include('partials._javascript')
@endsection

