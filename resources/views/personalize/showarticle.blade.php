@extends('main')
@section('title',' My Article')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
<br>
<div class="container">
<div class="row mt-5b">
    <div class="col-md-8">
        <h1>{{$article->title}}</h1>
        <p class="lead">{!!$article->description!!}</p>
    </div>
    <div class="col-md-4">
        <dl class="well">
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
                    <a href="{{ route('articles.edit', $article->slug) }}" class="btn btn-primary btn-block">Edit</a>
                </div>
                <div class="col-sm-6">
                    {{ Form::open(['route'=>['articles.destroy',$article->id], 'method'=>'DELETE', 'onsubmit' => 'return confirmDelete()']) }}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger confirm btn-block', 'data-confirm' => 'Are you sure you want to delete?']) }}
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
            <div class="col-md-12">
                {{-- <a href="{{ route('articles.index', $article->id) }}" class="btn btn-default btn-block"><< See all articles</a> --}}
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('partials._javascript')
@endsection

@section('scripts')
    <script>
        $('.confirm').on('click', function (e) {
        if (confirm($(this).data('confirm'))) {
            return true;
        }
        else {
            return false;
        }
    });
    </script>
@endsection