@extends('main') 

@section('title',' People') 

@section('stylesheets')
  <meta name="csrf-token" content="{{ csrf_token() }}"> 
@endsection 

@section('content') 

@include('partials._nav')
<br>
<div class="container mt-4b justify-content-center">
    <div class="row">
    <div class="col-md-5">
      <h1>PEOPLE</h1>
    </div>
    <div class="col-md-7">
      <form action="{{url('/people')}}">
        <div class="row">
          <div class="col-md-9 form-group">
            <input type="text" class="form-control" name="search" id="search" style="font-size: 15px;" />
          </div>
          <div class="col-md-3">
            <button type="submit" id="button-filter" class="btn btn-primary pull-right" style="margin-right: 20px">
              <i class="fa fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
    </div>
    <br>
        </div>
    </div>

<div class="container mt-4 justify-content-center" style="display:flex;">
<div class="row">
        @foreach($people as $p)
        <div class="col-lg-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                            <div class="text-center">
                                    @if(($p->photo == 'images/unknown.png') && ($p->gender == 'Male'))
                                        <img src=" {{ asset('/images/man.png') }}" height="150px" alt="default-man">
                                    @elseif(($p->photo == 'images/unknown.png') && ($p->gender == 'Female'))
                                        <img src=" {{ asset('/images/woman.png') }}" height="150px" alt="default-woman">
                                    @else
                                        <img src="{{ asset('image/avatar/'. $p->photo) }}" height="150px" alt="User Image">
                                    @endif
                                </div>
                                <br>
                                <div class="container mt-3 display-5 text-muted text-center" style="font-size:18px;font-family:Avenir-Bold;">
                                        {{ $p->fullname }}
                                </div>
                                <br>
                                <p class="card-text">{{ substr(strip_tags($p->aboutme), 0, 150)}} {{strlen(strip_tags($p->aboutme))>150?"...":""}}</p>  
                    </div>
                    <div class="card-footer">
                            {{-- <span class="fa fa-hand-o-right"> --}}
                                    {{-- <ins> --}}
                                        <a href=" {{ route('people.show', $p->id_user) }} " class="btn btn-primary">See Profile</a>
                                    {{-- </ins> --}}
                                {{-- </span> --}}
                    </div>
                </div>
        </div>
            {{-- <div class="col">
                <div class="container row">
                    <div class="col-md-2">
                        <div class="text-center">
                            @if(($p->photo == 'images/unknown.png') && ($p->gender == 'Male'))
                                <img src=" {{ asset('/images/man.png') }}" style="width: 6em" alt="default-man">
                            @elseif(($p->photo == 'images/unknown.png') && ($p->gender == 'Female'))
                                <img src=" {{ asset('/images/woman.png') }}" style="width: 6em" alt="default-woman">
                            @else
                                <img src="{{ asset('image/avatar/'. $p->photo) }}" style="width: 8em" alt="User Image">
                            @endif
                        </div>

                        <div class="container mt-3 display-5 text-muted text-center">
                            {{ $p->fullname }}
                        </div>
                    </div>

                    <div class="col-md row">
                        <div class="col-md-7 lead">
                            <h5>About Me</h5>
                            <p>{{ $p->aboutme }}</p>
                        </div>

                        <div class="col-md-2 lead">
                            <h5>Profession</h5>
                            <p>{{ $p->profession }}</p>
                        </div>

                        <div class="col-md-3 lead">
                            <h5>Find Me in</h5>
                                <p>
                                    <ins>
                                        <a href=" {{$p->sociallinks}} ">
                                            {{ $p->sociallinks }}
                                        </a>
                                    </ins>
                                </p>
                                <p>
                                    <ins>
                                        <a href=" {{ $p->portfoliolinks }} ">
                                            {{ $p->portfoliolinks }}
                                        </a>
                                    </ins>
                                </p>
                            <h6>
                                <span class="fa fa-hand-o-right">
                                    <ins>
                                        <a href=" {{ route('people.show', $p->id_user) }} ">See My Full Profile</a>
                                    </ins>
                                </span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <hr> --}}
        @endforeach
</div>
</div>
<div class="row justify-content-md-center">
        <div class="col-md-auto">
         <div class="text-center">
           {{$people->links()}}
         </div>
         </div>
     </div>

@include('partials._javascript')
@endsection