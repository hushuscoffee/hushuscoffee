@extends('main') 
@section('title', '| Edit My Article') 
@section('content')
<div class="row">
  <div class="col-md-8">
    <h1 class="text-center">Edit Your Own Article</h1>
    {!! Form::model($article,['route'=>['article.update', $article->id], 'method'=>'PUT', 'enctype'=>"multipart/form-data"])!!}
    {{ Form::label('title', 'Title:')}} {{ Form::text('title', null, ["class"=> 'form-control input-lg'])}}<br>
    <div class="form-group"><label for="category">Category: </label>
      <select name="category" class="form-control">
                  @foreach($categories as $cat)
                <option value="{{$cat->id}}"
                    @if($cat->id==$article->category_id)
                    selected
                    @endif
                    >{{$cat->name}}</option>
                  @endforeach
                </select>
    </div>
    <div class="form-group">
      <label for="file">Cover Image: </label>
      <input type="file" class="form-control" id="DragAndDrop" onchange="imagePreview();" name="file">
    </div>
    <label for="file">Current Cover Image: </label><br>
    <img id="image" src="{{asset($article->image)}}" width="600px"><br><br> {{ Form::label('description', 'Description:',
    ['class'=> 'form-spacing-top'])}} {{ Form::textarea('description', null, ["class"=> 'form-control input-lg my-editor'])}}<br>
    <div class="form-group">
      <label for="share">Choose how you share it: </label>
      <select name="shared" class="form-control">
                  @foreach($shareds as $cat)
                <option value="{{$cat->id}}"
                    @if($cat->id==$article->shared_id)
                    selected
                    @endif
                    >{{$cat->name}}</option>
                  @endforeach
                </select>
    </div>
    <a href="{{ route('myArticle.show', $article->slug) }}" class="btn btn-danger">Cancel</a>
    <input type="submit" class="btn btn-primary" value="Save Changes">
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