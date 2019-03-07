@extends('main') 
@section('title', '| Home') 
@section('stylesheets')
<style>
    .carousel-inner img {
        width: 70%;
        max-height: 370px;
    }
    .title-capt{ 
        color:white;font-weight:bolder;background-color:rgb(0,0,0, 0.3);
    }
    .body-capt{
        color:white;font-weight:bolder;background-color:rgb(0,0,0, 0.3);
    }
    .image { width: 100%; height: auto; } .image-cover { width: 100%; max-height: 400px; }
</style>
@endsection
 
@section('content')
<div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
        <li data-target="#demo" data-slide-to="3"></li>
    </ul>
    <?php $flag=true; ?>
    <div class="carousel-inner">
        @foreach($brewings as $brewing)
        <div class="carousel-item {{ $flag==true ? " active " : " " }}">
            <img class="m-auto d-block" src="{{URL::to('uploads/brewings/'.$brewing->image)}}">
            <div class="carousel-caption">
                <a class="title-capt" href="{{route('myBrewing.show',$brewing->slug)}}">{{$brewing->title}}</a>
                <p class="body-capt" >{{ substr(strip_tags($brewing->description), 0, 80)}} {{strlen(strip_tags($brewing->description))>80?"...":""}}</p>
            </div>
        </div>
        <?php $flag=false; ?> 
        @endforeach 
        @foreach($recipes as $recipe)
        <div class="carousel-item">
            <img class="m-auto d-block" src="{{URL::to('uploads/recipes/'.$recipe->image)}}">
            <div class="carousel-caption">
                <a class="title-capt" href="{{route('myBrewing.show',$recipe->slug)}}">{{$recipe->title}}</a>
                <p class="body-capt">{{ substr(strip_tags($recipe->description), 0, 150)}} {{strlen(strip_tags($recipe->description))>150?"...":""}}</p>
            </div>
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<hr>
<div class="row">
    <div class="col-md-8">
        <div class="title sidebar-widget-area">
        <h4 class="title">Latest Articles</h4>
        </div>
        @foreach ($articles as $article)
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('myArticle.show', $article->slug)}}"><img class="image" src="{{asset('uploads/articles/'.$article->image)}}"></a>
                </div>
                <div class="col-md-9">
                    <a style="font-size:18px;font-weight:bolder;" href="{{route('myArticle.show', $article->slug)}}" data-toggle="tooltip" data-placement="left"
                        title="{{$article->title}}">{{$article->title}}</a>
                    <p style="font-size:14px;">{{ substr(strip_tags($article->description), 0, 200)}} {{strlen(strip_tags($article->description))>200?"...":""}}</p>
                    <p style="font-size:12px;">By : <a href="{{ route('people.show', $article->user_id) }}" style="font-size:12px;">{{$article->user->profile->fullname}}</a> on {{$article->created_at}}</p>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
    <div class="col-md-4">
        <div class="title sidebar-widget-area">
            <h4 class="title">People</h4>
        </div>
        @foreach ($people as $person)
        <div class="row">
            <div class="col-md-3">
                <a href="{{route('people.show', $person->user_id)}}"><img class="image" src="{{asset('images/avatar/'.$person->photo)}}"></a>
            </div>
            <div class="col-md-9">
                <a style="font-size:18px;font-weight:bolder;" href="{{route('people.show', $person->user_id)}}" data-toggle="tooltip" data-placement="left"
                    title="{{$person->fullname}}">{{$person->fullname}}</a>
                <p style="font-size:14px;">{{ substr(strip_tags($person->aboutme), 0, 80)}} {{strlen(strip_tags($person->aboutme))>80?"...":""}}</p>
            </div>
        </div>
        <hr> @endforeach
    </div>
</div>
@endsection