@extends('main')
@section('title',' My Article')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
        <div class="container mt-4" style"display:flex;">
    <div class="jumbotron" style="background-color:rgba(255, 255, 255, 0.7);">
        <center><h1>My Article</h1></center><hr>
        @if(count($articles)==0)
            <div class="alert alert-danger">
            <strong>Info!</strong> You haven&apos;t create any article! To create an article click <a href="{{route('articles.create')}}">here</a>
</div>
        @else
        <div class="row">
            @foreach($articles as $article)
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
          {{-- <h4 class="card-header">{{$article->title}}</h4> --}}
            <div class="card-body">
            {{-- <p>{{$article->id_category}}</p> --}}
            <center><img src="{{asset($article->file)}}" alt="" height="150px"></center><br><br>
            <a href="{{route('personalize.showarticle', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
                    <strong>
                      <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
                    </strong>
                  </a>
            <p class="card-text">{{ substr(strip_tags($article->description), 0, 150)}} {{strlen(strip_tags($article->description))>150?"...":""}}</p>
            </div>
            <div class="card-footer">
                <a href="{{route('personalize.showarticle', $article->slug)}}" class="btn btn-primary">Read More</a>
            {{-- @if($article->id_shared == 1)
          <a href="{{route('article.unshare', $article->id)}}" class="btn btn-danger pull-right"><i class="fa fa-share-alt-square"></i></a>
        @else
          <a href="{{route('article.share', $article->id)}}" class="btn btn-info pull-right"><i class="fa fa-share-alt-square"></i></a>
        @endif --}}
            </div>
          </div>
        </div>
        @endforeach
        </div>
        <div class="row justify-content-md-center">
                <div class="col-md-auto">
                 <div class="text-center">{{$articles->links()}}</div>
                 </div>
             </div>
        @endif
    </div>
        </div>
      @include('partials._javascript')
@endsection