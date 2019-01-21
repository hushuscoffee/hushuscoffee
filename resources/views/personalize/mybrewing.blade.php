@extends('main')
@section('title',' My Brewing')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    h1{
    font-family: Avenir-Bold;
  }
</style>
@endsection
@section('content')
@include('partials._nav')
        <div class="container mt-4" style"display:flex;">
    <div class="jumbotron" style="background-color:rgba(255, 255, 255, 0.7);">
        <center><h1>My Brewing Methods</h1></center><hr>
        @if(count($brewings)==0)
            <div class="alert alert-danger">
            <strong>Info!</strong> You haven&apos;t create any brewing method! To create a brewing method click <a href="{{route('personalize.brewing')}}">here</a>
    </div>
        @else
        <div class="row">
            @foreach($brewings as $brewing)
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
            <img src="{{asset($brewing->file)}}" alt="" width="100%"><br><br>
            <a href="{{route('brewing.show', $brewing->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$brewing->title}}">
                    <strong>
                      <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($brewing->title), 0, 70)}}{{strlen(strip_tags($brewing->title))>70?"...":""}}</p>
                    </strong>
                  </a>
            <p class="card-text">{{ substr(strip_tags($brewing->description), 0, 150)}} {{strlen(strip_tags($brewing->description))>150?"...":""}}</p>
            </div>
            <div class="card-footer">
                <a href="{{route('personalize.showbrewing', $brewing->slug)}}" class="btn btn-primary">Read More</a>
            {{-- @if($brewing->id_shared == 1)
          <a href="{{route('article.unshare', $brewing->id)}}" class="btn btn-danger pull-right"><i class="fa fa-share-alt-square"></i></a>
        @else
          <a href="{{route('article.share', $brewing->id)}}" class="btn btn-info pull-right"><i class="fa fa-share-alt-square"></i></a>
        @endif --}}
            </div>
          </div>
        </div>
        @endforeach
        </div>
        <div class="row justify-content-md-center">
           <div class="col-md-auto">
            <div class="text-center">{{$brewings->links()}}</div>
            </div>
        </div>
        @endif
    </div>
        </div>
      @include('partials._javascript')
@endsection