@extends('main') 

@section('title',' Professional Profile') 

@section('stylesheets')
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
@endsection 

@section('content') 
@include('partials._nav')

<div class="container">
  {{--
  <h3 class="mt-2">Profile Setting</h3> --}}
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
            <a class="w3-margin-top w3-hover-text-teal pull-right" style="font-size: 13px; color:grey" data-toggle="modal" href="#achievement">
              <i class="fa fa-plus-circle w3-text-teal"></i> Add Achievement</a>
            <br> --}}
          </div>

          <div class="container row">
            {{--
            <div class="modal fade" id="achievement">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Add Achievement</h4>
                  </div> --}}
                  <div class="col-md-8">
                    <label>Achievement</label>
                    <form class="w3-margin-top" enctype="multipart/form-data" role="form">
                      {{ csrf_field() }} {{--
                      <div class="modal-body"> --}}
                        <div class="form-group" >
                          <p>Title</p>
                          <input type="text" class="form-control" id="title" required name="title">
                        </div>
                        <div class="form-group" >
                          <p>Link</p>
                          <input type="text" class="form-control" id="link" name="link">
                        </div>
                        <div class="form-group" >
                          <p>Organizer</p>
                          <input type="text" class="form-control" id="issuer" required name="issuer">
                        </div>
                        <div class="form-group" >
                          <p>Month</p>
                          <select class="form-control" id="month" name="month">
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
                        </div>
                        <div class="form-group" >
                          <p>Year</p>
                          <select class="form-control" id="year" name="year">
                            {{$date = date('Y')}} 
                            @while($date>=$beforeyear1)
                              <option value="{{$date}}">{{$date}}</option>
                              {{$date--}} 
                            @endwhile
                          </select>
                        </div>
                        <div class="form-group" >
                          <p>Description</p>
                          <textarea class="form-control" id="description" rows="5" name="description" required></textarea>
                        </div>
                      {{--  </div>  --}}
                      {{-- <div class="modal-footer"> --}} 
                        {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn btn-primary pull-right mb-4" id="submitAjax">Save</button>
                        <input type="hidden" id="_token" value="{{ csrf_token() }}"> 
                      {{-- </div> --}}
                    </form>
                  </div>
                  {{-- </div> --}}
                <!-- /.modal-content -->
                {{-- </div> --}}
              <!-- /.modal-dialog -->
            {{--  </div>  --}}

            <div class="container col-md-4 mt-1" id="result-data">
              @if($proAchievement!=null) 
                @foreach ($proAchievement as $ach)
                  <p>{{$ach->title}}</p>
                  <p>
                    <a class="w3-text-blue" style="text-decoration: underline;" href="https://{{$ach->link}}" target="_blank">
                    {{$ach->link}}</a> {{$ach->issuer}}
                  </p>
                  <p>{{$ach->month}} {{$ach->year}}</p>
                  <p>{{$ach->description}}</p>
                  {{-- <br> --}}
                  <hr style="margin-top: 0px"> 
                @endforeach 
              @endif
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
      var dissuer = $('#issuer').val();
      var dmontht = $('#month').val();
      var dyeart = $('#year').val();
      var ddescription = $('#description').val();

      jQuery.ajax({
        url: '/users/professional/achievement',
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
          issuer: dissuer,
          month: dmontht,
          year: dyeart,
          description: ddescription
        },
        success: function (data) {
          //console.log('Success');
          $('#result-data').append(
            "<label>" + data.title + "</label>" +
            "<p>" + "<a style='text-decoration: underline;' href=" + data.link + " target='_blank'>" + data.link +
            "</a>" + data.issuer + "</p>" +
            "<p>" + data.month + " - " + data.year + "</p>" +
            "<p>" + data.description + "</p>" +
            "<hr style='margin-top: 0px'>"
          );
        }
      });
    });
  </script>
@endsection