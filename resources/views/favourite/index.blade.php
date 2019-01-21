<?php use Illuminate\Support\Facades\DB; ?>
@extends('main')
@section('title',' My Article')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
        <div class="container" style"display:flex;">
    <div class="jumbotron" style="background-color:rgba(255, 255, 255, 0.7);">
        <center><h1>My List Favorites</h1></center><hr>
        @if(count($favs)==0)
            <div class="alert alert-danger">
            <strong>Info!</strong> You haven't add any articles to favourites 
</div>
        @else
        <div class="row">
            @foreach($favs as $fav)
              <?php $article = DB::table('articles')->where('id', '=', $fav->id_article)->where('id_shared', '=', 1)->first(); ?>
              @if($article != null)
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
            {{-- <p>{{$article->id_category}}</p> --}}
            <center><img src="{{asset($article->file)}}" alt="" height="150px"></center>
            <br>
            <strong>
                <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
              </strong>
            <p class="card-text">{{ substr(strip_tags($article->description), 0, 150)}} {{strlen(strip_tags($article->description))>150?"...":""}}</p>
            </div>
            <div class="card-footer">
              @if($article->id_category==1)
        <a href="{{route('recipe.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($article->id_category==2)
        <a href="{{route('brewing.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($article->id_category==3)
        <a href="{{route('news.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($article->id_category==4)
        <a href="{{route('tips.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($article->id_category==5)
        <a href="{{route('event.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @endif
              <a href="{{route('favorite.remove', $fav->id)}}" class="btn btn-danger pull-right"><i class="fa fa-heart"></i></a>    
            </div>
          </div>
        </div>
        @endif
        @endforeach
        </div>
        {{-- <div class="text-center">  <center>{{$favs->links("pagination::bootstrap-4")}} </center></div> --}}
        @endif
    </div>
        </div>
      @include('partials._javascript')
@endsection