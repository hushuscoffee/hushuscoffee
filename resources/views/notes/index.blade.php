@extends('main') 
@section('title', '| My Note') 
@section('content')
    <div class="row" style="text-align:center;">
        <div class="col-md-4">
            <div class="jumbotron">
                <h4>BREWING</h4>
                <hr>
                <img src="{{asset('images/technique.png')}}" width="150" />
                <hr>
                <a class="btn btn-primary" href="#"><i class="fa fa-plus"></i> Add Brewing</a><br><br>
                <a class="btn btn-primary" href="#"><i class="fa fa-user"></i> My Brewing</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron">
                <h4>RECIPE</h4>
                <hr>
                <img src="{{asset('images/recipe.png')}}" width="150" />
                <hr>
                <a class="btn btn-primary" href="#"><i class="fa fa-plus"></i> Add Recipe</a><br><br>
                <a class="btn btn-primary" href="#"><i class="fa fa-user"></i> My Recipe</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron">
                <h4>ARTICLE</h4>
                <hr>
                <img src="{{asset('images/article.png')}}" width="150" />
                <hr>
                <a class="btn btn-primary" href="{{route('article.create')}}"><i class="fa fa-plus"></i> Add Article</a><br><br>
                <a class="btn btn-primary" href="{{route('article.all')}}"><i class="fa fa-user"></i> My Article</a>
            </div>
        </div>
    </div>
@endsection