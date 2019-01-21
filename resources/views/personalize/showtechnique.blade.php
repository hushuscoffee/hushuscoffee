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
        <div class="container">
    <div class="jumbotron" style="background-color:rgba(255, 255, 255, 0.8);">
        <h1>{{$article->title}}</h1>
        <p>{{$article->description}}</p>
    
    <?php $number=1 ?> 
    <h4>Steps to do</h4>
    @foreach($steps as $step)
        <p>Step {{$number}} : {{$step->description}}</p>
        <?php $number++ ?> 
    @endforeach
    </div>
    </div>
    </section>
    @include('partials._javascript')
@endsection