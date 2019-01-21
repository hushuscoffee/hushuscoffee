@extends('main')
@section('title',' Dashboard')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
<br><br>
    <div class="container mr-5 mt-5">
  
    <div class="row" style="text-align:center;">
    <div class="col-md-3">
        <div class="jumbotron">
            <h4>BREWING</h4><hr>
            <img src="{{asset('images/technique.png')}}" width="150"/><hr>
            <a class="btn btn-primary" href="{{route('personalize.brewing')}}"><i class="fa fa-plus"></i> Add Brewing</a><br><br>
            <a class="btn btn-primary" href="{{route('personalize.mybrewing')}}"><i class="fa fa-user"></i> My Brewing</a>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <div class="jumbotron">
        <h4>RECIPE</h4><hr>
        <img src="{{asset('images/recipe.png')}}" width="150"/><hr>
        <a class="btn btn-primary" href="{{route('personalize.recipe')}}"><i class="fa fa-plus"></i> Add Recipe</a><br><br>
        <a class="btn btn-primary" href="{{route('personalize.myrecipe')}}"><i class="fa fa-user"></i> My Recipe</a>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <div class="jumbotron">
        <h4>ARTICLE</h4><hr>
        <img src="{{asset('images/article.png')}}" width="150"/><hr>
        <a class="btn btn-primary" href="{{route('articles.create')}}"><i class="fa fa-plus"></i> Add Article</a><br><br>
        <a class="btn btn-primary" href="{{route('personalize.myarticle')}}"><i class="fa fa-user"></i> My Article</a>
        </div>
    </div>
    </div>
        </div>
@include('partials._javascript')
@section('scripts')
@endsection
@endsection