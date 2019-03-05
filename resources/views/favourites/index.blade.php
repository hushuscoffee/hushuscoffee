<?php use App\Article; use App\Brewing; use App\Recipe;  ?> 
@extends('main') 
@section('title', '| Favourites') 
@section('content')
<div class="row justify-content-md-center">
    <h1 class="text-center">Favourites</h1>
    @if($favs->count()==0)
    <div class="col-lg-12 mt-3 mb-3">
        <div class="alert alert-danger">
            <strong>Info!</strong> You have no list of favourites
        </div>
    </div>
</div>
@else 
<div class="row">@foreach($favs as $fav) @if($fav->article_id!=null)
    <?php $favourite = Article::where('id', '=', $fav->article_id)->where('shared_id', '=', 1)->first(); ?> @elseif($fav->brewing_id!=null)
    <?php $favourite = Brewing::where('id', '=', $fav->brewing_id)->where('shared_id', '=', 1)->first(); ?> @else
    <?php $favourite = Recipe::where('id', '=', $fav->recipe_id)->where('shared_id', '=', 1)->first(); ?> @endif
    <div class="col-lg-4 mt-3 mb-3">
        <div class="card h-100">
            <div class="card-body">
                @if($fav->article_id!=null)
                <a href="{{route('myArticle.show', $favourite->slug)}}"><img class="m-auto d-block" src="{{asset('uploads/articles/'.$favourite->image)}}" alt="" height="150px"></a><br><br>
                <a href="{{route('myArticle.show', $favourite->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$favourite->title}}"> 
                    @elseif($fav->brewing_id!=null)
                    <a class="text-center" href="{{route('myBrewing.show', $favourite->slug)}}"><img class="m-auto d-block" src="{{asset('uploads/brewings/'.$favourite->image)}}" alt="" height="150px"></a><br><br>
                <a href="{{route('myBrewing.show', $favourite->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$favourite->title}}"> 
                     @else
                    <a class="text-center" href="{{route('myRecipe.show', $favourite->slug)}}"><img class="m-auto d-block" src="{{asset('uploads/recipes/'.$favourite->image)}}" alt="" height="150px"></a><br><br>
                <a href="{{route('myRecipe.show', $favourite->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$favourite->title}}"> 
                     @endif
                        <strong>
                          <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($favourite->title), 0, 70)}}{{strlen(strip_tags($favourite->title))>70?"...":""}}</p>
                        </strong>
                      </a>
                <p class="card-text">{{ substr(strip_tags($favourite->description), 0, 150)}} {{strlen(strip_tags($favourite->description))>150?"...":""}}</p>
            </div>
            <div class="card-footer">
                @if($fav->article_id!=null)
                <a href="{{route('myArticle.show', $favourite->slug)}}" class="btn btn-primary">Read More</a> @elseif($fav->brewing_id!=null)
                <a href="{{route('myArticle.show', $favourite->slug)}}" class="btn btn-primary">Read More</a> @else
                <a href="{{route('myArticle.show', $favourite->slug)}}" class="btn btn-primary">Read More</a> @endif
                <a href="{{route('favourite.remove', $fav->id)}}" class="btn btn-danger float-right"><i class="fa fa-heart"></i></a>
            </div>
        </div>
    </div>
    @endforeach @endif
</div>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="text-center">{{$favs->links()}}</div>
    </div>
</div>
@endsection