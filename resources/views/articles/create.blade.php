@extends('main') 
@section('title', '| Create New Article') 
@section('content')
<div class="row">
    <div class="col-md-8">
        <h1 class="text-center">Make Your Own Article</h1>

        <form method="post" action="{{ route('article.store') }}" enctype="multipart/form-data" class="form-group">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" class="form-control" id="title" name="title" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="category">Category: </label>
                <select name="category" class="form-control">
            @foreach($categories as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
        </select>
            </div>
            <div class="form-group">
                <label for="file">Cover Image: </label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            {{ Form::label('description', 'Description:', ['class'=> 'form-spacing-top'])}} {{ Form::textarea('description', null, ["class"=>
            'form-control input-lg my-editor'])}}
            <div class="form-group">
                <label for="share">Choose how you share it: </label>
                <select name="shared" class="form-control input-group-text">
            @foreach($shareds as $sha)
                <option value="{{$sha->id}}">{{$sha->name}}</option>
            @endforeach
        </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right" name="status" value="1">Save to Draft</button>
                <button type="submit" class="btn btn-success pull-right" name="status" value="2">Publish</button>
            </div>
        </form>
    </div>
</div>
@endsection
 
@section('scripts') {!! Html::script('tinymce/js/tinymce/tinymce.min.js') !!}
<script>
    tinymce.init({ selector:'textarea', branding: false, min_height: 500, max_width : 730
     });

</script>
@endsection