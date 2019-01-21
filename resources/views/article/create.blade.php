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
    <script src="{{URL::to('vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    {{-- <script>
        tinymce.init({
            selector: 'textarea',
            plugins:['link','image imagetools','code','lists']
        });
    </script> --}}
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

<div class="container mt-5b">
  <div class="row container justify-content-center">
    <div class="col-md col-md-offset-0">
      <div class="container mt-3">
        <h1 class="text-center">Make Your Own Article</h1>

        <form method="post" action="{{ route('articles.store') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" class="form-control" id="title" name="title" required maxlength="255">
            </div>
            <div class="form-group">
                <label for="category">Category: </label>
                <select name="category" class="form-control">
                  @foreach($categorys as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="file">Cover Image: </label>
                <input type="file" class="form-control" id="file" name="file">
            </div>
            <div class="form-group">
                <label for="description">Description: </label>
                <textarea name="description" class="form-control my-editor"></textarea>
            </div>
            <div class="form-group">
                <label for="share">Choose how you share it: </label>
                <select name="shared" class="form-control input-group-text">
                  @foreach($shared as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                  @endforeach
                </select>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
    
</div>
@include('partials._javascript')
@endsection