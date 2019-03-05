@extends('main') 
@section('title') | Article {{$article->title}} 
@section('stylesheets')
<style>
    .image {
        width: 100%;
        height: auto;
    }

    .image-cover {
        width: 100%;
        max-height: 400px;
    }
</style>
@endsection

@endsection
 
@section('content')
<div class="row">
    <div class="col-md-8">
        <h1>{{$article->title}}</h1>
        <img class="image-cover" src="{{asset('uploads/articles/'.$article->image)}}" width="700px" />
        <p class="lead">{!!$article->description!!}</p>
    </div>
    <div class="col-md-4">
        @if (Auth::check()) @if (Auth::user()->id==$article->user_id)
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
            <hr> @endif @endif
            <h5>Related Articles</h5>
            <hr> @foreach ($articles as $article)
            <div class="row">
                <div class="col-md-4">
                    <a href="{{route('myArticle.show', $article->slug)}}"><img class="image" src="{{asset('uploads/articles/'.$article->image)}}"></a>
                </div>
                <div class="col-md-8">
                    <a style="font-size:14px;" href="{{route('myArticle.show', $article->slug)}}" data-toggle="tooltip" data-placement="left"
                        title="{{$article->title}}">{{$article->title}}</a>
                    <p style="font-size:12px;">By : <a href="#" style="font-size:12px;">{{$article->user->profile->fullname}}</a> on {{$article->created_at}}</p>
                </div>
            </div>
            <hr> @endforeach
    </div>

</div>
@endsection