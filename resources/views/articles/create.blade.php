@extends('main') 
@section('title', '| Create New Article') 
@section('stylesheets')
<style>
    img {
        width: 100%;
        height: auto;
    }
</style>
@endsection
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">Make Your Own Article</h1>
    </div>
</div>
<br><br>

<div class="row">
    <div class="col-md-9">
        <form method="post" action="{{ route('article.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-2">
                    <strong><label>Title</label></strong>
                </div>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="title" name="title" required maxlength="255">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <strong><label>Category</label></strong>
                </div>
                <div class="col-md-10">
                    <select name="category" class="form-control">
                        @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <strong><label>Cover Image</label></strong>
                </div>
                <div class="col-md-10">
                    <input type="file" class="form-control" id="DragAndDrop" onchange="imagePreview();" name="file">
                    <br>
                    <img id="image">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <strong><label>Description</label></strong>
                </div>
                <div class="col-md-10">
                    {{ Form::textarea('description', null, ["class"=> 'form-control input-lg my-editor'])}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2">
                    <strong><label>Choose how you share it</label></strong>
                </div>
                <div class="col-md-10">
                    <select name="shared" class="form-control input-group-text">
                            @foreach($shareds as $sha)
                                <option value="{{$sha->id}}">{{$sha->name}}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <button type="submit" class="btn btn-primary pull-right" name="status" value="1">Save to Draft</button>
                    <button type="submit" class="btn btn-success pull-right" name="status" value="2">Publish</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">

    </div>
</div>
@endsection
 
@section('scripts') {!! Html::script('tinymce/js/tinymce/tinymce.min.js') !!}
<script>
    tinymce.init({ selector:'textarea', branding: false, min_height: 500, max_width : 730
     });

</script>
<script>
    function imagePreview() { var iRead = new FileReader(); iRead.readAsDataURL(document.getElementById("DragAndDrop").files[0]);
    iRead.onload = function(oFREvent) { document.getElementById("image").src = oFREvent.target.result; }; }

</script>
@endsection