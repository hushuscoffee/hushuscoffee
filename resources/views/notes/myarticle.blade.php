@extends('main') 
@section('title', '| My Article') 
@section('content')
<center>
    <h1>My Article</h1>
</center>
@if(count($articles)==0)
<div class="alert alert-danger">
    <strong>Info!</strong> You haven&apos;t create any article! To create an article click <a href="{{route('article.create')}}">here</a>
</div>
@else
<div class="btn-group btn-group-toggle">
    <a href="{{route('article.all')}}" class="btn btn-outline-warning {{ Request::is('note/article/all') ? "active" : "" }}"> All</a>
    <a href="{{route('article.events')}}" class="btn btn-outline-warning {{ Request::is('note/article/events') ? "active" : "" }}"> Events</a>
    <a href="{{route('article.news')}}" class="btn btn-outline-warning {{ Request::is('note/article/news') ? "active" : "" }}"> News</a>
    <a href="{{route('article.tips')}}" class="btn btn-outline-warning {{ Request::is('note/article/tips') ? "active" : "" }}"> Tips</a>
</div>
<div class="row">
    @include('partials._article')
</div>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="text-center">{{$articles->links()}}</div>
    </div>
</div>
@endif
@endsection