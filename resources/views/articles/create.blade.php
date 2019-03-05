@extends('main') 
@section('title', '| Create New Article') 
@section('stylesheets')
<style>
    .cover-image {
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
                    <img class="cover-image" id="image">
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
                    <button type="submit" class="btn btn-primary pull-right" name="status" value="1">SAVE</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3">
        @if(count($articles)==0)
        <div class="alert alert-danger">
            <strong>Info!</strong> There is no latest article. You haven&apos;t create any article!</a>
        </div>
        @else 
        @endif
    </div>
</div>
@endsection
 
@section('scripts') {!! Html::script('tinymce/js/tinymce/tinymce.min.js') !!}
<script>
    tinymce.init({ selector:'textarea', branding: false, min_height: 500,
        plugins: 'table wordcount link image media',
  content_css: [
    '{{ asset('css/custom_font.css')}}'
  ],
  toolbar: "undo redo | bold italic underline | fontsizeselect fontselect| forecolor backcolor | link image media",

  style_formats: [
    { title: 'Bold text', inline: 'strong' },
    { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
    { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
    { title: 'Badge', inline: 'span', styles: { display: 'inline-block', border: '1px solid #2276d2', 'border-radius': '5px', padding: '2px 5px', margin: '0 2px', color: '#2276d2' } },
    { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
  ],
  formats: {
    alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left' },
    aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center' },
    alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right' },
    alignfull: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full' },
    bold: { inline: 'span', 'classes': 'bold' },
    italic: { inline: 'span', 'classes': 'italic' },
    underline: { inline: 'span', 'classes': 'underline', exact: true },
    strikethrough: { inline: 'del' },
    customformat: { inline: 'span', styles: { color: '#00ff00', fontSize: '20px' }, attributes: { title: 'My custom format' }, classes: 'example1' }
  },
  fontsize_formats: '11px 12px 14px 16px 18px 24px 36px 48px',
  font_formats: 'Avenir-Regular=Avenir-Regular;Avenir-Medium=Avenir-Medium;Avenir-Bold=Avenir-Bold',
  color_map: [
    "000000", "Black",
    "993300", "Burnt orange",
    "333300", "Dark olive",
    "003300", "Dark green",
    "003366", "Dark azure",
    "000080", "Navy Blue",
    "333399", "Indigo",
    "333333", "Very dark gray",
    "800000", "Maroon",
    "FF6600", "Orange",
    "808000", "Olive",
    "008000", "Green",
    "008080", "Teal",
    "0000FF", "Blue",
    "666699", "Grayish blue",
    "808080", "Gray",
    "FF0000", "Red",
    "FF9900", "Amber",
    "99CC00", "Yellow green",
    "339966", "Sea green",
    "33CCCC", "Turquoise",
    "3366FF", "Royal blue",
    "800080", "Purple",
    "999999", "Medium gray",
    "FF00FF", "Magenta",
    "FFCC00", "Gold",
    "FFFF00", "Yellow",
    "00FF00", "Lime",
    "00FFFF", "Aqua",
    "00CCFF", "Sky blue",
    "993366", "Red violet",
    "FFFFFF", "White",
    "FF99CC", "Pink",
    "FFCC99", "Peach",
    "FFFF99", "Light yellow",
    "CCFFCC", "Pale green",
    "CCFFFF", "Pale cyan",
    "99CCFF", "Light sky blue",
    "CC99FF", "Plum"
  ]
     });

</script>
<script>
    function imagePreview() { var iRead = new FileReader(); iRead.readAsDataURL(document.getElementById("DragAndDrop").files[0]);
    iRead.onload = function(oFREvent) { document.getElementById("image").src = oFREvent.target.result; }; }

</script>
@endsection