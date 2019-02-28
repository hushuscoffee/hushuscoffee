@extends('main') 
@section('title') | Article {{$article->title}}
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{$article->title}}</h1>
        <img src="{{asset($article->image)}}" width="700px" />
        <p class="lead">{!!$article->description!!}</p>
    </div>
    @if (Auth::check())
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
                    <a href="{{ route('article.edit', $article->slug) }}" class="btn btn-primary btn-block">Edit</a>
                </div>
                <div class="col-sm-6">
                    {{ Form::open(['route'=>['article.destroy',$article->id], 'method'=>'DELETE', 'onsubmit' => "return confirm('Are you sure
                    you want to delete?')"]) }} {{ Form::submit('Delete',['class'=>'btn btn-danger confirm btn-block']) }}
                    {{ Form::close() }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
    </div>
    @endif

</div>
@endsection