@extends('main') 

@section('title',' Professional Profile')  
@section('stylesheets')
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
@endsection 

@section('content') 
@include('partials._nav')

<div class="container">
  {{-- <h4 class="mt-2">Profile Setting</h4> --}}
  <div class="row container mt-3 justify-content-center">
    {{-- @include('layout.sideprofilesetting') --}}

    <div class="col col-md-offset-0">
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

            {{-- <a class="w3-margin-top w3-hover-text-teal pull-right" style="font-size: 13px; color:grey" data-toggle="modal" href="#skill">
              <i class="fa fa-plus-circle w3-text-teal"></i> Add New Skill</a>
            <br> --}}
          </div>

          <div class="container row mt-3">
            {{-- <div class="modal fade" id="skill">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add New Skill</h4>
                  </div> --}}
                  <div class="col-md">
                    <label>Skill</label>
                    <form class="w3-margin-top" enctype="multipart/form-data" role="form">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <p>Skill</p>
                          <input type="text" placeholder="ex: Data Analysis" class="form-control" id="skill" required name="skill">
                        </div>
                        <div class="form-group">
                          <p>Proficiency</p>
                          <select class="form-control" id="skill-proficiency" required name="proficiency">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Professional">Professional</option>
                          </select>
                        </div>
                        <button type="button" class="btn btn-primary pull-right" id="submitAjaxSkill">Save</button>
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    </form>
                  </div>
                {{-- </div> --}}
                <!-- /.modal-content -->
              {{-- </div> --}}
              <!-- /.modal-dialog -->
            {{-- </div> --}}
            <div class="col" id="result-data-skill">
              @foreach($proSkill as $sk)
                <big>  
                  <span class="badge badge-pill badge-secondary" title="{{$sk->proficiency}}">{{$sk->skill}}</span>
                </big>
              @endforeach
            </div>
          </div>
          <hr>

          <div class="container row">
            {{-- <div class="modal fade" id="language">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add new language</h4>
                  </div> --}}
                  <div class="container col-md-8">
                    <label>Language</label>
                    <form class="w3-margin-top" enctype="multipart/form-data" role="form">
                      {{ csrf_field() }}
                        <div class="form-group">
                          <p>Language</p>
                          <input type="text" placeholder="ex: English" class="form-control" id="language" required name="language">
                        </div>
                        <div class="form-group">
                          <p>Proficiency</p>
                          <select class="form-control" id="lang-proficiency" required name="proficiency">
                            <option value="Elementary">Elementary proficiency</option>
                            <option value="Limited working">Limited working proficiency</option>
                            <option value="Professional working">Professional working proficiency</option>
                            <option value="Full professional">Full professional proficiency</option>
                            <option value="Native or bilingual">Native or bilingual proficiency</option>
                          </select>
                        </div>
                      {{-- <div class="modal-footer"> --}}
                        {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save"> --}}
                        <button type="button" class="btn btn-primary pull-right mb-4" id="submitAjaxLanguage">Save</button>
                        <input type="hidden" id="_token" value="{{ csrf_token() }}">
                      {{-- </div> --}}
                    </form>
                  </div>
                {{-- </div> --}}
                <!-- /.modal-content -->
              {{-- </div> --}}
              <!-- /.modal-dialog -->
            {{-- </div> --}}
            <div class="col" id="result-data-language">
              @foreach($proLanguage as $lang)
                <p>{{$lang->language}}</p>
                <p>{{$lang->proficiency}} proficiency</p>
                <hr> 
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
@include('partials._javascript')

  <script>
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#submitAjaxSkill').click(function (e) {
        e.preventDefault();

        var dskill = $('#skill').val();
        var dproficiency = $('#skill-proficiency').val();

        jQuery.ajax({
          url: '/users/professional/skill',
          method: 'post',
          /*beforeSend: function (xhr) {
            var token = $('meta[name="csrf-token"]').attr('content');
            if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
          },*/
          data: {
            _token: $('input[id=_token]').val(),
            skill: dskill,
            proficiency: dproficiency,
          },
          success: function (data) {
            //console.log('Success');
            $('#result-data-skill').append(
              "<big> <span class='badge badge-pill badge-secondary' title=" + data.proficiency + ">" + data.skill + "</span> </big>"
            );
          }
        });
      });

      $('#submitAjaxLanguage').click(function (e) {
        e.preventDefault();

        var dlang = $('#language').val();
        var dproficiency = $('#lang-proficiency').val();

        jQuery.ajax({
          url: '/users/professional/language',
          method: 'post',
          /*beforeSend: function (xhr) {
            var token = $('meta[name="csrf-token"]').attr('content');
            if (token) {
              return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
          },*/
          data: {
            _token: $('input[id=_token]').val(),
            language: dlang,
            proficiency: dproficiency,
          },
          success: function (data) {
            //console.log('Success');
            $('#result-data-language').append(
                "<p>" + data.language + "</p>" +
                "<p>" + data.proficiency + "</p>" +
                "<hr>"
            );
          }
        });
      });
    </script>
@endsection
