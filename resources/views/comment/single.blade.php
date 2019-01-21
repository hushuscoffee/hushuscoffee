<!-- @extends('main')

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
<div id="comment-form">
{{Form::open(['route'=>['comments.store', $post->id]])}}
</div>
</div>

@endsection -->