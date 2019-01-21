{{-- @extends('main')
@section('title', '| View Post')
@section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins:['link','image imagetools','code','lists']
        });
    </script>
@endsection
@section('content') --}}
@extends('main')
@section('title',' Dashboard')
@section('stylesheets')
<style>
  label{
    font-weight: bolder;
    font-size: 20px;
  }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
{!! Html::style('css/parsley.css') !!}
    <script>
    function imagePreview() {
    var iRead = new FileReader();
    iRead.readAsDataURL(document.getElementById("DragAndDrop").files[0]);
    iRead.onload = function(oFREvent) {
        document.getElementById("image").src = oFREvent.target.result;
    };
}
    </script>
    <script src="{{URL::to('vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script>
  var editor_config = {
    path_absolute : "{{URL::to('/')}}/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern",
      "autoresize advlist autolink lists link image charmap print preview anchor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection
@section('content')
    @include('partials._nav')
    <br>
{!! Form::model($article,['route'=>['articles.update', $article->id], 'method'=>'PUT', 'enctype'=>"multipart/form-data"])!!}
<div class="container">
<div class="row">    
        <div class="col-md-12">
            {{ Form::label('title', 'Title:')}}
            {{ Form::text('title', null, ["class"=> 'form-control input-lg'])}}<br>
            {{-- {{ Form::label('file', 'Cover Image:')}}<br>
            {{ Form::file('file', null, ['id'=>"DragAndDrop", 'onchange'=>"imagePreview();", "class"=> 'form-control input-lg'])}}<br><br> --}}
            <div class="form-group">
                <label for="category">Category: </label>
                <select name="category" class="form-control">
                  @foreach($categorys as $cat)
                <option value="{{$cat->id}}"
                    @if($cat->id==$article->id_category)
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
        <img id="image" src="{{asset($article->file)}}" width="600px"><br><br>
            {{ Form::label('description', 'Description:', ['class'=> 'form-spacing-top'])}}
            {{ Form::textarea('description', null, ["class"=> 'form-control input-lg  my-editor'])}}<br>
            <div class="form-group">
                <label for="share">Choose how you share it: </label>
                <select name="shared" class="form-control">
                  @foreach($shared as $cat)
                <option value="{{$cat->id}}"
                    @if($cat->id==$article->id_shared)
                    selected
                    @endif
                    >{{$cat->name}}</option>
                  @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('personalize.showarticle', $article->slug) }}" class="btn btn-danger pull-right">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save Changes" style="float:right;margin-right:25px;">
                </div>
            </div>
</div>
    {!! Form::close()!!}

    @include('partials._javascript')
@endsection