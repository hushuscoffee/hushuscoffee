@extends('main') 

@if($category==1) 
  @section('title',' Recipe') 
@elseif($category==2) 
  @section('title',' Brewing Method')
@elseif($category==3) 
  @section('title',' News') 
@elseif($category==4) 
  @section('title',' Tips') 
@elseif($category==5) 
  @section('title','Events') 
@endif @section('stylesheets')

<meta name="csrf-token" content="{{ csrf_token() }}">
{{--  <style>
  input[type="text"] {
    border: 1px solid grey;
    width: 100%;
    padding: 7px 15px;
    box-sizing: border-box;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
  }

  ::placeholder {
    opacity: 0.5;
  }
</style>  --}}
@endsection @section('content') @include('partials._nav')
<br>
<div class="container">
  <div class="row mt-4b">
    @if($category==1)
    <br>
    <div class="col-md-5">
      <h1>RECIPE</h1>
    </div>
    <div class="col-md-7">
      <form action="{{url('/recipe')}}">
        <div class="row">
          <div class="col-md-9 form-group">
            <input type="text" class="form-control" name="search" id="search" style="font-size: 15px;" />
          </div>
          <div class="col-md-3">
            <button type="submit" id="button-filter" class="btn btn-primary pull-right" style="margin-right: 20px">
              <i class="fa fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
    <hr> @elseif($category==2)
    <br>
    <div class="col-md-5">
      <h1>BREWING METHOD</h1>
    </div>
    <div class="col-md-7">
      <form action="{{url('/brewing')}}">
        <div class="row">
          <div class="col-md-9 form-group">
            <input type="text" class="form-control" name="search" id="search" style="font-size: 15px;" />
          </div>
          <div class="col-md-3">
            <button type="submit" id="button-filter" class="btn btn-primary pull-right" style="margin-right: 20px">
              <i class="fa fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
    <hr> @elseif($category==3)
    <br>
    <div class="col-md-4">
      <h1>NEWS</h1>
    </div>
    <div class="col-md-8">
      <form action="{{url('/news')}}">
        <div class="row">
          <div class="col-md-10 form-group">
            <input type="text" class="form-control" name="search" id="search" style="font-size: 15px;" />
          </div>
          <div class="col-md-2">
            <button type="submit" id="button-filter" class="btn btn-primary pull-right" style="margin-right: 20px">
              <i class="fa fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
    <hr> @elseif($category==4)
    <br>
    <div class="col-md-4">
      <h1>TIPS</h1>
    </div>
    <div class="col-md-8">
      <form action="{{url('/tips')}}">
        <div class="row">
          <div class="col-md-10 form-group">
            <input type="text" class="form-control" name="search" id="search" style="font-size: 15px;" />
          </div>
          <div class="col-md-2">
            <button type="submit" id="button-filter" class="btn btn-primary pull-right" style="margin-right: 20px">
              <i class="fa fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
    <hr> @elseif($category==5)
    <br>
    <div class="col-md-4">
      <h1>EVENTS</h1>
    </div>
    <div class="col-md-8">
      <form action="{{url('/event')}}">
        <div class="row">
          <div class="col-md-10 form-group">
            <input type="text" class="form-control" name="search" id="search" style="font-size: 15px;" />
          </div>
          <div class="col-md-2">
            <button type="submit" id="button-filter" class="btn btn-primary pull-right" style="margin-right: 20px">
              <i class="fa fa-search"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
    <hr> @endif
  </div>
</div>
<br>
<div class="container" style"display:flex;">
  <div class="row">
    @if(count($articles)==0)
    <div class="alert alert-danger">
      <strong>Info!</strong> There is no article that match with the title!</a>
    </div>
    @else @foreach($articles as $article)
    <div class="col-lg-4 mb-4">
      <div class="card h-100">
          {{-- @if($category==1)
          <a href="{{route('recipe.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
            <strong>
              <p class="card-header" style="font-size:18px;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
            </strong>
          </a>
          @elseif($category==2)
          <a href="{{route('brewing.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
            <strong>
              <p class="card-header" style="font-size:18px;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
            </strong>
          </a>
          @elseif($category==3)
          <a href="{{route('news.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
            <strong>
              <p class="card-header" style="font-size:18px;height:100px">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
            </strong>
          </a>
          @elseif($category==4)
          <a href="{{route('tips.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
            <strong>
              <p class="card-header" style="font-size:18px;height:100px">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
            </strong>
          </a>
          @elseif($category==5)
          <a href="{{route('event.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
            <strong>
              <p class="card-header" style="font-size:18px;height:100px">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
            </strong>
          </a>
          @endif --}}
        <div class="card-body">
          @if($category==1)
          <a href="{{route('recipe.show', $article->slug)}}">
            <center><img src="{{asset($article->file)}}" alt="" height="150px"></center>
          </a>
          @elseif($category==2)
          <a href="{{route('brewing.show', $article->slug)}}">
            <center><img src="{{asset($article->file)}}" alt="" height="150px"></center>
          </a>
          @elseif($category==3)
          <a href="{{route('news.show', $article->slug)}}">
            <center><img src="{{asset($article->file)}}" alt="" height="150px"></center>
          </a>
          @elseif($category==4)
          <a href="{{route('tips.show', $article->slug)}}">
            <center><img src="{{asset($article->file)}}" alt="" height="150px"></center>
          </a>
          @elseif($category==5)
          <a href="{{route('event.show', $article->slug)}}">
            <center><img src="{{asset($article->file)}}" alt="" height="150px"></center>
          </a>
          @endif
          <br>
          <br>
          @if($category==1)
        <a href="{{route('recipe.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
          <strong>
            <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
          </strong>
        </a>
        @elseif($category==2)
        <a href="{{route('brewing.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
          <strong>
            <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
          </strong>
        </a>
        @elseif($category==3)
        <a href="{{route('news.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
          <strong>
            <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
          </strong>
        </a>
        @elseif($category==4)
        <a href="{{route('tips.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
          <strong>
            <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
          </strong>
        </a>
        @elseif($category==5)
        <a href="{{route('event.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
          <strong>
            <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
          </strong>
        </a>
        @endif
          <p class="card-text">{{ substr(strip_tags($article->description), 0, 150)}} {{strlen(strip_tags($article->description))>150?"...":""}}</p>
        </div>
        <div class="card-footer">
        @if($category==1)
        <a href="{{route('recipe.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($category==2)
        <a href="{{route('brewing.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($category==3)
        <a href="{{route('news.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($category==4)
        <a href="{{route('tips.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @elseif($category==5)
        <a href="{{route('event.show', $article->slug)}}" class="btn btn-primary">Read More</a>
        @endif
        @if(Auth::check())
        @if($article->id_user != Auth::user()->id)
        <?php $favor=false; ?>
        @foreach ( $favorites as $fav)
            @if($fav->id_article == $article->id)
              <a href="{{route('favorite.remove', $fav->id)}}" class="btn btn-danger pull-right"><i class="fa fa-heart"></i></a>    
              <?php $favor=true; ?>
            @endif
        @endforeach
        @if($favor==false)
          <a href="{{route('favorite.add', $article->id)}}" class="btn btn-outline-danger pull-right"><i class="fa fa-heart"></i></a>
        @endif
        @else
        {{-- @if($article->id_shared == 1)
          <a href="{{route('article.unshare', $article->id)}}" class="btn btn-danger pull-right"><i class="fa fa-share-alt-square"></i></a>
        @else
          <a href="{{route('article.share', $article->id)}}" class="btn btn-info pull-right"><i class="fa fa-share-alt-square"></i></a>
        @endif --}}
        @endif
        @endif
        </div>
      </div>
    </div>
    @endforeach @endif
  </div>
  <div class="row justify-content-md-center">
           <div class="col-md-auto">
            <div class="text-center">
              {{$articles->links()}}
            </div>
            </div>
        </div>
</div>
@include('partials._javascript') @section('scripts') @endsection @endsection