@extends('main') 
@section('title', '| Create New Brewing') 
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
    img { width: 100%; height: auto; }
</style>
@endsection
 
@section('content')

<form method="post" action="{{route('brewing.store')}}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">
                Make Your Own Brewing Method
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
            <img id="image">
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
    <div class="row">
        <div class="col-md-2">
            <strong><label>Brewing time</label></strong>
        </div>
        <div class="col-md-3 form-group">
            <input type="number" class="form-control" id="time1" min="1" name="time1" required>
        </div>
        <div class="col-md-1">
            <label>until</label>
        </div>
        <div class="col-md-3 form-group">
            <input type="number" class="form-control" id="time2" min="1" name="time2" required>
        </div>
        <div class="col-md-3">
            <div class="input-group-prepend ">
                <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipTimePrepend" name="second">
                    <option value="second">second</option>
                    <option selected value="minute">minute</option>
                    <option value="hour">hour</option>
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-2">
            <strong><label>Water temperature </label></strong>
        </div>
        <div class="col-md-7 form-group">
            <input type="number" class="form-control" id="temperature" min="1" name="temperature" required>
        </div>
        <div class="col-md-3">
            <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipTemperaturePrepend" name="celcius">
                    <option selected value="&deg;C">&deg;C</option>
                    <option value="&deg;F">&deg;F</option>
                    <option value="&deg;K">&deg;K</option>
                    <option value="&deg;R">&deg;R</option>
            </select>
        </div>
    </div>
    <br>
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
                    <button type="button" class="btn btn-outline-primary pull-right add-material"><img src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
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
                    <button type="button" class="btn btn-outline-primary pull-right add-tool"><img src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <div class="content_step">
        <div class="row">
            <div class="col-md-2">
                <strong><label>Steps</label></strong>
            </div>
            <div class="col-md-7 form-group">
                <textarea name="step[]" class="form-control" id="step" rows="3" required></textarea>
            </div>
            <div class="col-md-2">
                <input type="file" name="stepImage[]" class="form-control" value="none" id="DragAndDrop0" onchange="imageStepPreview(0);" style="margin-bottom:20px"/>
                <img id="image0" />
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <button type="button" class="btn btn-outline-primary pull-right add-step"><img src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
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
<script type="text/javascript">
    tinymce.init({
        //mode : "textareas",
        selector: "textarea#myTextEditor", 
        branding: false, 
        min_height: 300, 
        max_width : 730
    });
</script>

<script>
    $(document).ready(function(){
        var i = 1;
        $('.add-step').click(function(){
            $('.content_step').append('<div id="content_step'+i+'" style="margin-bottom:30px"><div class="row"> <div class="col-md-2"></div><div class="col-md-7 form-group"><textarea name="step[]" class="form-control" id="step" rows="3" required></textarea><input type="text" value="none" name="imageName[]" hidden/></div><div class="col-md-2"><input type="file" name="stepImage[]" class="form-control" id="DragAndDrop'+i+'" onchange="imageStepPreview('+i+');" style="margin-bottom:20px"/><img id="image'+i+'" /></div><div class="col-md-1"><div class="form-group"><button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove_step">Remove </button></div></div></div></div>');
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