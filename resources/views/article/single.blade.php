@extends('main')
@section('title', 'Comment')
@section ('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{$post->title}}</h1>
            <p>{{$post->body}}</p>
            <hr>
            <p>Posted In: {{$post->category->name}}</p>
        </div>
    </div>

    <div class="row">
        <div id="comment-form" class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
            {{Form::open(['route'=>['comments.store', $post->id], 'method' => 'POST']) }}
                <div class="row">
                    <div class="col-md-6">
                    {{Form::label('name',"Name: ")}}
                    {{Form::text('name', null,['class' => 'form-control'])}}
                        </div>
                    </div>
    </div>
    </div>

    @endsection