@extends('main') 
@section('title', '| Create New Recipe') 
@section('stylesheets')
<style>
    input[type="text"],
    input[type="number"] {
        border: 1px solid grey;
        width: 100%;
        padding: 5px 12px;
        box-sizing: border-box;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 16px;
        resize: none;
    }

    input[type="file"] {
        border: 1px solid #b5afaf;
        display: inline-block;
        padding: 3px 15px;
        cursor: pointer;
        width: 100%;
    }

    textarea {
        border: 1px solid grey;
        width: 100%;
        padding: 12px 15px;
        box-sizing: border-box;
        border-radius: 4px;
        background-color: #f8f8f8;
        font-size: 15px;
        resize: none;
    }
    .cover-image { width: 100%; height: auto; }
</style>
@endsection
 
@section('content')

<form method="post" action="{{route('recipe.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                Make Your Own Recipe
            </h1>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-2">
            <strong><label>Title</label></strong>
        </div>
        <div class="col-md-7 form-group">
            <input name="title" class="form-control" type="text" required/>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <strong><label>Cover image</label></strong>
        </div>
        <div class="col-md-7">
            <input name="cover" type="file" class="form-control" id="DragAndDrop" onchange="imagePreview();"/>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-7">
            <img class="cover-image" id="image">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <strong><label>Description</label></strong>
        </div>
        <div class="col-md-7 form-group">
            <textarea name="description" id="myTextEditor"></textarea>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <h4>What You&apos;ll Need</h4>
        </div>
    </div>
    <div class="content_material">
        <div class="row">
            <div class="col-md-2">
                <strong><label>Ingredients</label></strong>
            </div>
            <div class="col-md-7 form-group">
                <input type="text" class="form-control" name="materialName[]" id="inputMaterials" required>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input type="number" class="form-control" id="inputUnits" name="materialAmount[]" min="1" required>
                    <div class="input-group-prepend ">
                        <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="materialUnit[]">
                        <option selected value="gr">gr</option>
                        <option value="ml">ml</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-primary pull-right add-material"><img class="cover-image" src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="content_tool">
        <div class="row">
            <div class="col-md-2">
                <strong><label>Tools</label></strong>
            </div>
            <div class="col-md-7 form-group">
                <input type="text" class="form-control" name="toolName[]" id="inputTools" required>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input type="number" class="form-control" id="inputUnits" name="toolAmount[]" required>
                    <div class="input-group-prepend ">
                        <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="toolUnit[]">
                            <option selected value="unit">unit</option>
                            <option value="piece">piece</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-primary pull-right add-tool"><img class="cover-image" src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="content_step">
        <div class="row" style="margin-bottom:30px">
            <div class="col-md-2">
                <strong><label>Steps</label></strong>
            </div>
            <div class="col-md-7 form-group">
                <textarea name="step[]" class="form-control" id="step" rows="3" required></textarea>
            </div>
            <div class="col-md-2">
                <input type="file" name="stepImage[]" class="form-control" value="none" id="DragAndDrop0" onchange="imageStepPreview(0);" style="margin-bottom:20px"/>
                <img class="cover-image" id="image0" />
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-primary pull-right add-step"><img class="cover-image" src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2"><strong><label>Choose how you shared it</label></strong></div>
        <div class="col-md-7"><select name="shared" class="form-control input-group-text selectpicker show-menu-arrow">
                @foreach($shareds as $sha)
                <option value="{{$sha->id}}">{{$sha->name}}</option>
                @endforeach
            </select></div>
        <div class="col-md-3"></div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-7">
            <button type="submit" class="btn btn-primary pull-right" name="status" value="1">SAVE</button>
        </div>
        <div class="col-md-3"></div>
    </div>
</form>
@endsection
 
@section('scripts') 
{!! Html::script('tinymce/js/tinymce/tinymce.min.js') !!}
<script>
    tinymce.init({ selector: "textarea#myTextEditor", branding: false, min_height: 500,
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
    $(document).ready(function(){
        var i = 1;
        $('.add-step').click(function(){
            $('.content_step').append('<div id="content_step'+i+'" style="margin-bottom:30px"><div class="row"> <div class="col-md-2"></div><div class="col-md-7 form-group"><textarea name="step[]" class="form-control" id="step" rows="3" required></textarea><input type="text" value="none" name="imageName[]" hidden/></div><div class="col-md-2"><input type="file" name="stepImage[]" class="form-control" id="DragAndDrop'+i+'" onchange="imageStepPreview('+i+');" style="margin-bottom:20px"/><img class="cover-image" id="image'+i+'" /></div><div class="col-md-1"><div class="form-group"><button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove_step">Remove </button></div></div></div></div>');
            i++;
        });

        $('.add-material').click(function(){
            $('.content_material').append('<div id="content_material'+i+'"><br><div class="row"><div class="col-md-2"></div><div class="col-md-7"><input type="text" name="materialName[]" id="inputMaterials" required></div><div class="col-md-2"><div class="input-group"><input type="number" class="form-control" id="inputUnits" name="materialAmount[]" placeholder="" required><div class="input-group-prepend "><select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="materialUnit[]"><option selected value="gr">gr</option><option value="ml">ml</option></select></div></div></div><div class="col-md-1"><div class="form-group"><button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove_material"> Remove</button></div></div></div></div>');
            i++;
        });

        $('.add-tool').click(function(){
            $('.content_tool').append('<div id="content_tool'+i+'"><br><div class="row"><div class="col-md-2"></div><div class="col-md-7"><input type="text" name="toolName[]" id="inputTools" required></div><div class="col-md-2"><div class="input-group"><input type="number" class="form-control" id="inputUnits" name="toolAmount[]" placeholder="" required><div class="input-group-prepend "><select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="toolUnit[]"><option selected value="unit">unit</option><option value="piece">piece</option></select></div></div></div><div class="col-md-1"><div class="form-group"><button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove_tool"> Remove </button></div></div></div></div>');
            i++;
        });

        $(document).on('click', '.remove_step', function(){  
            var button_id = $(this).attr("id");   
            $('#content_step'+button_id+'').remove();  
       });

        $(document).on('click', '.remove_material', function(){  
            var button_id = $(this).attr("id");   
            $('#content_material'+button_id+'').remove();  
        });

        $(document).on('click', '.remove_tool', function(){  
            var button_id = $(this).attr("id");   
            $('#content_tool'+button_id+'').remove();  
       });
    });

</script>
<script>
    function imagePreview() { var iRead = new FileReader(); iRead.readAsDataURL(document.getElementById("DragAndDrop").files[0]);
    iRead.onload = function(oFREvent) { document.getElementById("image").src = oFREvent.target.result; }; }

</script>
<script>
    function imageStepPreview(data) { 
        var iRead = new FileReader();
        iRead.readAsDataURL(document.getElementById("DragAndDrop"+data).files[0]);
    iRead.onload = function(oFREvent) { document.getElementById("image"+data).src = oFREvent.target.result; }; }

</script>
@endsection