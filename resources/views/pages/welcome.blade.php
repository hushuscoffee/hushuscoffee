@extends('main')
@section('title','| Homepage')
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="jumbotron">
    <h1 class="display-4">Welcome to my coffee blog</h1>
    {{-- <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a> --}}
    </div>
        </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        @foreach($articles as $article)
        <div class="post">
          <h3>{{$article->title}}</h3>
          <p>{{ substr(strip_tags($article->description), 0, 300)}} {{strlen(strip_tags($article->description))>300?"...":""}}</p>
          <a href="{{route('articles.show', $article->id)}}" class="btn btn-primary">Read More</a>
        </div>
        <hr>
        @endforeach
      </div>
       <div class="col-md-3 col-md-offset-1">
        {{-- Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. --}}
    </div>
    </div>
@endsection

