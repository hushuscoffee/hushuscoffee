@extends('main') 
@section('title', '| Edit My Article')
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
    <h1 class="text-center">Edit Your Own Article</h1>
  </div>
</div>
<br><br>

<div class="row">
  <div class="col-md-9">
    {!! Form::model($article,['route'=>['article.update', $article->id], 'method'=>'PUT', 'enctype'=>"multipart/form-data"])!!}
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-2">
          <strong><label>Title</label></strong>
        </div>
        <div class="col-md-10">
          <input type="text" class="form-control" id="title" name="title" required maxlength="255" value="{{$article->title}}">
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
                        <option value="{{$cat->id}}" @if($cat->id==$article->category_id) selected @endif >{{$cat->name}}
                        </option>
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
          <img id="image" src="{{asset($article->image)}}">
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
                            @foreach($shareds as $cat)
                            <option value="{{$cat->id}}" @if($cat->id==$article->shared_id) selected @endif >{{$cat->name}}
                            </option>
                            @endforeach
                        </select>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-10">
          <a href="{{ route('myArticle.show', $article->slug) }}" class="btn btn-danger">Cancel</a>
          <input type="submit" class="btn btn-primary" value="Save Changes">
        </div>
      </div>
    {!! Form::close()!!}
  </div>
  <div class="col-md-3">

  </div>
</div>
@endsection
 {!! Form::close()!!} 
@section('scripts') {!! Html::script('tinymce/js/tinymce/tinymce.min.js') !!}
<script>
  tinymce.init({ selector:'textarea', height : "800", max_width : "700" });
  function imagePreview() { var iRead = new FileReader(); iRead.readAsDataURL(document.getElementById("DragAndDrop").files[0]);
  iRead.onload = function(oFREvent) { document.getElementById("image").src = oFREvent.target.result; }; }

</script>
@endsection