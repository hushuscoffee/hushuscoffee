@extends('main')
@section('title',' Home')
@section('stylesheets')
  <!-- Custom styles for this template -->
    <link href="{{ asset('css/business-casual.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/creative.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
@endsection
@section('content')
    {{-- <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">A Free Bootstrap 4 Business Theme</span>
      <span class="site-heading-lower">Business Casual</span>
    </h1> --}}
    @include('partials._nav')
    <section class="clearfix">
        <div class="container" style"display:flex;">
    <div class="jumbotron" style="background-color:rgba(255, 255, 255, 0.7);">
        <center><h1>My Technique</h1></center><hr>
        <div class="row">
            @foreach($techniques as $technique)
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
          <h4 class="card-header">{{$technique->title}}</h4>
            <div class="card-body">
            <p class="card-text">{{$technique->description}}</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
        @endforeach
        </div>
        <div class="text-center">{!!$technique->links();!!}</div>
    </div>
        </div>
        </section>
    @include('partials._javascript')
@endsection