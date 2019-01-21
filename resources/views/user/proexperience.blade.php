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
          <br>
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
            <div class="alert alert-danger alert-dismissible" role="alert" >
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-right:30px;">
                <span aria-hidden="true">&times;</span>
              </button>
              {{ session('error') }}
            </div>
            @endif {{--
            <a class="w3-margin-top pull-right" style="font-size: 13px; color:grey" data-toggle="modal" href="#work">
              <i class="fa fa-plus-circle w3-text-teal"></i> Add Work Experience</a>
            <br> --}}
          </div>

          <div class="container row">
            {{--
            <div class="modal fade" id="work">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title pull-left">Add Work Experience</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div> --}}

                  <div class="col-md-8">
                    <label>Work Experience</label>
                    <form class="w3-margin-top" enctype="multipart/form-data" role="form">
                      {{ csrf_field() }} 
                        <div class="form-group">
                          <p>Title</p>
                          <input type="text" class="form-control" id="title" required name="title">
                        </div>
                        <div class="form-group">
                          <p>Link</p>
                          <input type="text" class="form-control" id="link" name="link">
                        </div>
                        <div class="form-group">
                          <p>Company</p>
                          <input type="text" class="form-control" id="company" required name="company">
                        </div>
                        <div class="form-group" >
                          <p>Position</p>
                          <input type="text" class="form-control" id="position" required name="position">
                        </div>
                        <div class="form-group" >
                          <p>Location</p>
                          <input type="text" class="form-control" id="location" required name="location">
                        </div>
                        <div class="form-group w3-col m5" >
                          <p>From Month</p>
                          <select class="form-control" id="monthf" name="monthf">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                          <br>
                          <p>From Year</p>
                          <select class="form-control" id="yearf" name="yearf">
                            {{$date = date('Y')}} @while($date>=$beforeyear1)
                            <option value="{{$date}}">{{$date}}</option>
                            {{$date--}} @endwhile
                          </select>
                        </div>
                        <div class="form-group w3-col m5 col-md-offset-2">
                          <p>To Month</p>
                          <select class="form-control" id="montht" name="montht">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                          </select>
                          <br>
                          <p>To Year</p>
                          <select class="form-control" id="yeart" name="yeart">
                            {{$date = date('Y')}} @while($date>=$beforeyear1)
                            <option value="{{$date}}">{{$date}}</option>
                            {{$date--}} @endwhile
                          </select>
                        </div>
                        <div class="form-group">
                          <p>Description</p>
                          <textarea class="form-control" rows="5" id="description" name="description"></textarea>
                        </div>
                          <button type="button" class="btn btn-primary pull-right" id="submitAjax">Save</button>
                          <input type="hidden" id="_token" value="{{ csrf_token() }}"> 
                    </form>
                  </div>
                    {{-- </div> --}}
                  <!-- /.modal-content -->
                  {{-- </div> --}}
                <!-- /.modal-dialog -->
                {{-- </div> --}}
              <br>
              <hr>

              <div class="col" id="result-data">
                @if($proExperience!=null) @foreach ($proExperience as $exp)
                <label>{{$exp->title}}</label>
                <p>{{$exp->company}}, {{$exp->location}}</p>
                <p> 
                  <a style="text-decoration: underline;" href="{{$exp->link}}" target="_blank">
                  {{$exp->link}}</a>
                </p>
                <p>{{$exp->monthf}} {{$exp->yearf}} - {{$exp->montht}} {{$exp->yeart}}</p>
                <p>{{$exp->description}}</p>
                <hr style="margin-top: 0px"> @endforeach @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
{{-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> --}}
@include('partials._javascript')
  
  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#submitAjax').click(function (e) {
      e.preventDefault();

      var dtitle = $('#title').val();
      var dlink = $('#link').val();
      var dcompany = $('#company').val();
      var dposition = $('#position').val();
      var dlocation = $('#location').val();
      var dmonthf = $('#monthf').val();
      var dyearf = $('#yearf').val();
      var dmontht = $('#montht').val();
      var dyeart = $('#yeart').val();
      var ddescription = $('#description').val();

      jQuery.ajax({
        url: '/users/professional/experience',
        method: 'post',
        /*beforeSend: function (xhr) {
          var token = $('meta[name="csrf-token"]').attr('content');
          if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
          }
        },*/
        data: {
          _token: $('input[id=_token]').val(),
          title: dtitle,
          link: dlink,
          company: dcompany,
          position: dposition,
          location: dlocation,
          monthf: dmonthf,
          yearf: dyearf,
          montht: dmontht,
          yeart: dyeart,
          description: ddescription
        },
        success: function (data) {
          //console.log('Success');
          $('#result-data').append(
            "<label>" + data.title + "</label>" +
            "<p>" + data.company + " " + data.location + "</p>" +
            "<p>" + "<a style='text-decoration: underline;' href=" + data.link + " target='_blank'>" + data.link +
            "</a>" + "</p>" +
            "<p>" + data.monthf + " " + data.yearf + " - " + data.montht + " " + data.yeart + "</p>" +
            "<p>" + data.description + "</p>" +
            "<hr style='margin-top: 0px'>"
          );
        }
      });
    });
  </script>

  @endsection