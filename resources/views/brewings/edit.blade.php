@extends('main') 
@section('title', '| Edit Your Brewing') 
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
 
@section('content') {!! Form::model($brewing,['route'=>['brewing.update', $brewing->id], 'method'=>'PUT', 'enctype'=>"multipart/form-data"])!!}
{{ csrf_field() }}
<div class="row">
    <div class="col-md-12">
        <h1 class="text-center">
            Edit Your Own Brewing Method
        </h1>
    </div>
</div>
<br><br>
<div class="row">
    <div class="col-md-2">
        <strong><label>Title</label></strong>
    </div>
    <div class="col-md-7 form-group">
        <input name="title" class="form-control" type="text" required value="{{$brewing->title}}" />
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2">
        <strong><label>Cover image</label></strong>
    </div>
    <div class="col-md-7">
        <input name="cover" type="file" class="form-control" id="DragAndDrop" onchange="imagePreview();" />
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-7">
        <img id="image" src="{{asset('uploads/brewings/'.$brewing->image)}}">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-2">
        <strong><label>Description</label></strong>
    </div>
    <div class="col-md-7 form-group">
        {{ Form::textarea('description', null, ["class"=> 'form-control input-lg my-editor', "id"=>"myTextEditor"])}}
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h4>What You&apos;ll Need</h4>
    </div>
</div>
<?php $time = json_decode($brewing->time) ?>
<div class="row">
    <div class="col-md-2">
        <strong><label>Brewing time</label></strong>
    </div>
    <div class="col-md-3 form-group">
        <input type="number" class="form-control" id="time1" min="1" name="time1" required value="{{$time->time1}}">
    </div>
    <div class="col-md-1">
        <label>until</label>
    </div>
    <div class="col-md-3 form-group">
        <input type="number" class="form-control" id="time2" min="1" name="time2" required value="{{$time->time2}}">
    </div>
    <div class="col-md-3">
        <div class="input-group-prepend ">
            <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipTimePrepend" name="second">
                    <option @if($time->unit=="second") selected @endif value="second">second</option>
                    <option @if($time->unit=="minute") selected @endif value="minute">minute</option>
                    <option @if($time->unit=="hour") selected @endif value="hour">hour</option>
                </select>
        </div>
    </div>
</div>
<br>
<?php $temperature = json_decode($brewing->temperature) ?>
<div class="row">
    <div class="col-md-2">
        <strong><label>Water temperature </label></strong>
    </div>
    <div class="col-md-7 form-group">
        <input type="number" class="form-control" id="temperature" min="1" name="temperature" required value="{{$temperature->temperature}}">
    </div>
    <div class="col-md-3">
        <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipTemperaturePrepend" name="celcius">
                    <option @if($temperature->unit=="&deg;C") selected @endif value="&deg;C">&deg;C</option>
                    <option @if($temperature->unit=="&deg;F") selected @endif value="&deg;F">&deg;F</option>
                    <option @if($temperature->unit=="&deg;K") selected @endif value="&deg;K">&deg;K</option>
                    <option @if($temperature->unit=="&deg;R") selected @endif value="&deg;R">&deg;R</option>
            </select>
    </div>
</div>
<br>
<?php $i=1 ?>
<?php $ingredients = json_decode($brewing->ingredients) ?>
<div class="content_material">
    @foreach($ingredients as $key => $ingredient) @if($key==0)
    <div class="row">
        <div class="col-md-2">
            <strong><label>Ingredients</label></strong>
        </div>
        <div class="col-md-7 form-group">
            <input type="text" class="form-control" name="materialName[]" id="inputMaterials" required value="{{$ingredient->name}}">
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <input type="number" class="form-control" id="inputUnits" name="materialAmount[]" required value="{{$ingredient->amount}}">
                <div class="input-group-prepend ">
                    <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="materialUnit[]">
                        <option @if($ingredient->unit=="gr") selected @endif value="gr">gr</option>
                        <option @if($ingredient->unit=="ml") selected @endif value="ml">ml</option>
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
    @else
    <div id="content_material{{$i}}"><br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7"><input type="text" name="materialName[]" id="inputMaterials" required value="{{$ingredient->name}}"></div>
            <div class="col-md-2">
                <div class="input-group"><input type="number" class="form-control" id="inputUnits" name="materialAmount[]" placeholder="" required
                        value="{{$ingredient->amount}}">
                    <div class="input-group-prepend "><select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend"
                            name="materialUnit[]"><option @if($ingredient->unit=="gr") selected @endif value="gr">gr</option>
                        <option @if($ingredient->unit=="ml") selected @endif value="ml">ml</option></select></div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group"><button type="button" id="{{$i}}" class="btn btn-outline-danger pull-right remove_material"> Remove</button></div>
            </div>
        </div>
    </div>
    <?php $i++; ?> @endif @endforeach
</div>
<br>
<hr>
<?php $tools = json_decode($brewing->tools) ?>
<div class="content_tool">
    @foreach($tools as $key => $tool) @if($key==0)
    <div class="row">
        <div class="col-md-2">
            <strong><label>Tools</label></strong>
        </div>
        <div class="col-md-7 form-group">
            <input type="text" class="form-control" name="toolName[]" id="inputTools" required value="{{$tool->name}}">
        </div>
        <div class="col-md-2">
            <div class="input-group">
                <input type="number" class="form-control" id="inputUnits" name="toolAmount[]" required value="{{$tool->amount}}">
                <div class="input-group-prepend ">
                    <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="toolUnit[]">
                            <option @if($tool->unit=="unit") selected @endif value="unit">unit</option>
                            <option @if($tool->unit=="piece") selected @endif value="piece">piece</option>
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
    @else
    <div id="content_tool{{$i}}"><br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7"><input type="text" name="toolName[]" id="inputTools" required value="{{$tool->name}}"></div>
            <div class="col-md-2">
                <div class="input-group"><input type="number" class="form-control" id="inputUnits" name="toolAmount[]" required value="{{$tool->amount}}">
                    <div class="input-group-prepend "><select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend"
                            name="toolUnit[]"><option @if($tool->unit=="unit") selected @endif value="unit">unit</option>
                    <option @if($tool->unit=="piece") selected @endif value="piece">piece</option></select></div>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group"><button type="button" id="{{$i}}" class="btn btn-outline-danger pull-right remove_tool"> Remove </button></div>
            </div>
        </div>
    </div>
    <?php $i++; ?> @endif @endforeach
</div>
<br>
<hr>
<?php $steps = json_decode($brewing->steps) ?>
<?php $step_images = json_decode($brewing->step_images) ?>
<div class="content_step">
    @foreach($steps as $key => $step) @if($key==0)
    <div class="row" style="margin-bottom:30px">
        <div class="col-md-2">
            <strong><label>Steps</label></strong>
        </div>
        <div class="col-md-7 form-group">
            <textarea name="step[]" class="form-control" id="step" rows="3" required>{{$step}}</textarea>
            <input type="text" value="{{$step_images[$key]}}" hidden name="imageName[]"/>
        </div>
        <div class="col-md-2">
        <input type="file" name="stepImage[]" class="form-control" id="DragAndDrop0" onchange="imageStepPreview(0);" value="{{$step_images[$key]}}" style="margin-bottom:20px"/> @if($step_images[$key]!='none')
                <img src="{{asset('uploads/brewings/steps/'.$step_images[$key])}}" id="image0" />@else <img id="image0" />  @endif</div>
        <div class="col-md-1">
            <div class="form-group">
                <button type="button" class="btn btn-outline-primary pull-right add-step"><img src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
            </div>
        </div>
    </div>
    @else
    <div id="content_step{{$i}}" style="margin-bottom:30px">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7 form-group"><textarea name="step[]" class="form-control" id="step" rows="3" required>{{$step}}</textarea><input type="text" value="{{$step_images[$key]}}" hidden name="imageName[]"/></div>
            <div class="col-md-2"><input type="file" name="stepImage[]" class="form-control" id="DragAndDrop{{$i}}" onchange="imageStepPreview({{$i}});" value="{{$step_images[$key]}}" style="margin-bottom:20px"/>
                @if($step_images[$key]!='none')
                <img src="{{asset('uploads/brewings/steps/'.$step_images[$key])}}" id="image{{$i}}" />@else <img id="image{{$i}}" />  @endif</div>
            <div class="col-md-1">
                <div class="form-group"><button type="button" id="{{$i}}" class="btn btn-outline-danger pull-right remove_step">Remove </button></div>
            </div>
        </div>
    </div>
    <?php $i++; ?> @endif @endforeach
</div>
<br>
<div class="row">
    <div class="col-md-2"><strong><label>Choose how you shared it</label></strong></div>
    <div class="col-md-7"><select name="shared" class="form-control input-group-text selectpicker show-menu-arrow">
                @foreach($shareds as $cat)
                <option value="{{$cat->id}}" @if($cat->id==$brewing->shared_id) selected @endif >{{$cat->name}}
                </option>
                @endforeach
            </select></div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <button type="submit" class="btn btn-success pull-right">Update</button>
    </div>
    <div class="col-md-3"></div>
</div>
{!! Form::close()!!}
@endsection
 
@section('scripts') {!! Html::script('tinymce/js/tinymce/tinymce.min.js') !!}
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
        var i = "<?php echo $i ?>";
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