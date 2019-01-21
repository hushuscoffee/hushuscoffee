@extends('main')
@section('title',' My Recipe')
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
        <center><h1>My Recipes</h1></center><hr>
        @if(count($recipes)==0)
            <div class="alert alert-danger">
            <strong>Info!</strong> You haven&apos;t create any recipe! To create a recipe click <a href="{{route('personalize.recipe')}}">here</a>
</div>
        @else
        <div class="row">
            @foreach($recipes as $recipe)
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
            <center><img src="{{asset($recipe->file)}}" alt="" height="150px"></center><br><br>
            <a href="{{route('recipe.show', $recipe->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$recipe->title}}">
                    <strong>
                      <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($recipe->title), 0, 70)}}{{strlen(strip_tags($recipe->title))>70?"...":""}}</p>
                    </strong>
                  </a>
            <p class="card-text">{{ substr(strip_tags($recipe->description), 0, 150)}} {{strlen(strip_tags($recipe->description))>150?"...":""}}</p>
            </div>
            <div class="card-footer">
                <a href="{{route('personalize.showrecipe', $recipe->slug)}}" class="btn btn-primary">Read More</a>
            {{-- @if($recipe->id_shared == 1)
          <a href="{{route('article.unshare', $recipe->id)}}" class="btn btn-danger pull-right"><i class="fa fa-share-alt-square"></i></a>
        @else
          <a href="{{route('article.share', $recipe->id)}}" class="btn btn-info pull-right"><i class="fa fa-share-alt-square"></i></a>
        @endif --}}
            </div>
            </div>
        </div>
            @endforeach
            </div>
            <div class="row justify-content-md-center">
           <div class="col-md-auto">
            <div class="text-center">{{$recipes->links()}}</div>
            </div>
        </div>
        @endif
    </div>
        </div>
      @include('partials._javascript')
@endsection