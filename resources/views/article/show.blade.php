@extends('main')
@section('title',' My Article')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
<br>
<div class="container mt-5">
<div class="row mt-5">
    <div class="col-md-8">
        <h1 style="font-size:25px">{{$article->title}}</h1>
    <img src="{{asset($article->file)}}" width="600px"/>
        <p class="lead">{!!$article->description!!}</p>
    </div>
    {{-- <div class="col-md-4">
        <dl class="well">
            <dl class="dl-horizontal">
                <label>URL Slug:</label>
            <p><a href="{{url($article->slug)}}">{{url($article->slug)}}</a></p>
            </dl>
            <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('M j, Y h:ia', strtotime($article->created_at))}}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{ date('M j, Y h:ia', strtotime($article->updated_at))}}</p>
            </dl>
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-primary btn-block">Edit</a>
                </div>
                <div class="col-sm-6">
                    {{ Form::open(['route'=>['articles.destroy',$article->id], 'method'=>'DELETE']) }}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger btn-block']) }}
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                <a href="{{ route('articles.index', $article->id) }}" class="btn btn-default btn-block"><< See all articles</a>
            </div>
            </div>
        </div>
    </div> --}}
</div>
<hr>
<div class="row">
    <div class="col-md-12">
    <section class="comment">
@include('partials._commentview')
@include('partials._commentform')
</section>
    </div>
</div>
</div>

      @include('partials._javascript')
@endsection