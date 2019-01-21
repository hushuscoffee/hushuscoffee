@extends('main')
@section('title',' Search')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
<br>
<div class="container mt-4b">
@if(count($articles)==0 && count($people)==0)
<div class="alert alert-danger">
            <strong>Info!</strong> There is no article or people that match with the search key!</a>
</div>
  @else
  @if(count($articles)!=0)
<h1>Article</h1>
<div class="container" style="display:flex">
  <div class="row">
@foreach($articles as $article)
          <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              @if($article->id_category==1)
            <a href="{{route('recipe.show', $article->slug)}}">
              <center><img src="{{asset($article->file)}}" alt="" height="150px" ></a></center>
            @elseif($article->id_category==2)
            <a href="{{route('brewing.show', $article->slug)}}">
              <center><img src="{{asset($article->file)}}" alt="" height="150px" ></a></center>
            @elseif($article->id_category==3)
            <a href="{{route('news.show', $article->slug)}}">
              <center><img src="{{asset($article->file)}}" alt="" height="150px" ></a></center>
            @elseif($article->id_category==4)
            <a href="{{route('tips.show', $article->slug)}}">
              <center><img src="{{asset($article->file)}}" alt="" height="150px" ></a></center>
            @elseif($article->id_category==5)
            <a href="{{route('event.show', $article->slug)}}">
              <center><img src="{{asset($article->file)}}" alt="" height="150px" ></a></center>
            @endif
            <br><br>
            @if($article->id_category==1)
            <a href="{{route('recipe.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
              <strong><p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p></strong></a>
            @elseif($article->id_category==2)
            <a href="{{route('brewing.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
              <strong><p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p></strong></a>
            @elseif($article->id_category==3)
            <a href="{{route('news.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
              <strong><p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p></strong></a>
            @elseif($article->id_category==4)
            <a href="{{route('tips.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
              <strong><p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p></strong></a>
            @elseif($article->id_category==5)
            <a href="{{route('event.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
              <strong><p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p></strong></a>
            @endif
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
  @endforeach
  </div></div>
<div class="row justify-content-md-center">
           <div class="col-md-auto">
            <div class="text-center">{{$articles->links()}}</div>
            </div>
        </div>
<hr>
@endif
@if(count($people)!=0)
<section class="people">
<h1>People</h1>
<div class="container mt-3 justify-content-center">
@foreach($people as $p)
        <div class="col">
            <div class="container row">
                <div class="col-md-2">
                    <div class="text-center">
                        @if(($p->photo == 'images/unknown.png') && ($p->gender == 'Male'))
                            <img src=" {{ asset('/images/man.png') }}" style="width: 6em" alt="default-man">
                        @elseif(($p->photo == 'images/unknown.png') && ($p->gender == 'Female'))
                            <img src=" {{ asset('/images/woman.png') }}" style="width: 6em" alt="default-woman">
                        @else
                            <img src="{{ $p->photo }}" style="width: 6em" alt="image">
                        @endif
                    </div>

                    <div class="container mt-3 display-5 text-muted text-center">
                        {{ $p->fullname }}
                    </div>
                </div>

                <div class="col-md row">
                    <div class="col-md-7 lead">
                        <h5>About Me</h5>
                        <p>{{ $p->aboutme }}</p>
                    </div>

                    <div class="col-md-2 lead">
                        <h5>Profession</h5>
                        <p>{{ $p->profession }}</p>
                    </div>

                    <div class="col-md-3 lead">
                        <h5>Find Me in</h5>
                            <p>
                                <ins>
                                    <a href=" {{$p->sociallinks}} ">
                                        {{ $p->sociallinks }}
                                    </a>
                                </ins>
                            </p>
                            <p>
                                <ins>
                                    <a href=" {{ $p->portfoliolinks }} ">
                                        {{ $p->portfoliolinks }}
                                    </a>
                                </ins>
                            </p>
                        <h6>
                            <span class="fa fa-hand-o-right">
                                <ins>
                                    <a href=" {{ route('people.show', $p->id_user) }} ">See My Full Profile</a>
                                </ins>
                            </span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    @endforeach
</div>
<div class="row justify-content-md-center">
           <div class="col-md-auto">
            <div class="text-center">{{$people->links()}}</div>
            </div>
        </div>
</section>
@endif
@endif
</div>
@include('partials._javascript')
@section('scripts')
@endsection
@endsection