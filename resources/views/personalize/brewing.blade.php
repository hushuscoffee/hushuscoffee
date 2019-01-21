@extends('main')
@section('title',' Add Brewing Method')
@section('stylesheets')
<style>input[type="text"], input[type="number"]{
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
    padding: 6px 12px;
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

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
<div class="container mt-5b">
      <form method="post" action="{{route('personalize.brewing-create')}}" enctype="multipart/form-data">
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
            <input id="file-upload" name="cover" type="file" class="form-control"/>
		</div>
    </div>
    <br>
    <div class="row">
		<div class="col-md-2">
            <strong><label>Description</label></strong>
		</div>
		<div class="col-md-7 form-group">
            <textarea name="description" class="form-control" rows="7" required></textarea>
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
            {{-- <strong><label>Brewing time <img src="{{ URL::to('/images/stopwatch.png') }}" style="width: 25px; height: 25px"></label></strong> --}}
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
                    <option value="Seconds">s</option>
                    <option selected value="Minutes">m</option>
                    <option value="Hours">h</option>
                </select>
            </div>
		</div>
    </div>
    <br>
    <div class="row">
		<div class="col-md-2">
            {{-- <strong><label>Water Temperature <img src="{{ URL::to('/images/temperature.png') }}" style="width: 25px; height: 25px"></label></strong> --}}
            <strong><label>Water temperature </label></strong>
		</div>
		<div class="col-md-7 form-group">
            <input type="number" class="form-control" id="temperature" min="1" name="temperature" required>
		</div>
		<div class="col-md-3">
            <select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipTemperaturePrepend" name="celcius">
                    <option selected value="C">&deg;C</option>
                    <option value="F">&deg;F</option>
                    <option value="K">&deg;K</option>
                    <option value="R">&deg;R</option>
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
                <input type="number" class="form-control" id="inputUnits" name="materialAmount[]" required>
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
            {{-- <strong><p>Steps <img src="{{ URL::to('/images/step.png') }}" style="width: 25px; height: 25px"></p></strong> --}}
            <strong><label>Steps</label></strong>
        </div>
		<div class="col-md-7 form-group">
            <textarea name="step[]" class="form-control" id="step" rows="3"  required></textarea>
		</div>
		<div class="col-md-2">
            <input type="file" name="stepImage1" class="form-control"/>
            {{-- <label class="nav-link">Step image <i class="fa fa-arrow-up"></i></label> --}}
            </div>
        <div class="col-md-1">
            <div class="form-group">
                <button id="add_step" type="button" class="btn btn-outline-primary pull-right add-step"><img src="{{ URL::to('/images/add.png') }}" style="width: 25px; height: 25px"></button>
            </div>
        </div>
      </div>
      </div>
      <br>
      <div class="row">
            <div class="col-md-2"><strong><label>Choose how you shared it</label></strong></div>
            <div class="col-md-7"><select name="shared" class="form-control input-group-text selectpicker show-menu-arrow">
                <option value="1">Public</option>
                <option value="2">Private</option>
            </select></div>
            <div class="col-md-3"></div>
      </div>
      <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                  {{-- <input  type="button" name="submit" id="submit" class="btn btn-outline-primary btn-lg pull-right" value="Save My Brewing Method"/> --}}
                  <button type="submit" class="btn btn-primary btn-lg pull-right">Save</button>
            </div>
            <div class="col-md-3"></div>
      </div>
      </form>
</div>
@include('partials._javascript')
@section('scripts')
<script>
        
    $(document).ready(function(){
        /*var postURL = "<?php echo url('create-brewing'); ?>"*/
        var i = 1;
        var x = 1;
        $('.add-step').click(function(){
            i++;
            x++;
            $('.content_step').append('<div id="content_step'+i+'"><div class="row"> <div class="col-md-2"></div><div class="col-md-7 form-group"><textarea name="step[]" class="form-control" id="step" rows="3" required></textarea></div><div class="col-md-2"><input type="file" name="stepImage'+x+'" class="form-control"/></div><div class="col-md-1"><div class="form-group"><button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove-step">Remove </button></div></div></div></div>');
        });

        $('.add-material').click(function(){
            i++;
            $('.content_material').append('<div id="content_material'+i+'"><br><div class="row"><div class="col-md-2"></div><div class="col-md-7"><input type="text" name="materialName[]" id="inputMaterials" placeholder="Enter the ingredient" required></div><div class="col-md-2"><div class="input-group"><input type="number" class="form-control" id="inputUnits" name="materialAmount[]" placeholder="" required><div class="input-group-prepend "><select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="materialUnit[]"><option selected value="gr">gr</option><option value="ml">ml</option></select></div></div></div><div class="col-md-1"><div class="form-group"><button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove_material"> Remove</button></div></div></div></div>');
        });

        $('.add-tool').click(function(){
            i++;
            $('.content_tool').append('<div id="content_tool'+i+'"><br><div class="row"><div class="col-md-2"></div><div class="col-md-7"><input type="text" name="toolName[]" id="inputTools" placeholder="Enter the tool" required></div><div class="col-md-2"><div class="input-group"><input type="number" class="form-control" id="inputUnits" name="toolAmount[]" placeholder="" required><div class="input-group-prepend "><select class="input-group-text selectpicker show-menu-arrow" id="validationTooltipMaterialUnitPrepend" name="toolUnit[]"><option selected value="unit">unit</option></select></div></div></div><div class="col-md-1"><div class="form-group"><button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove_tool"> Remove </button></div></div></div></div>');
        });

        $(document).on('click', '.remove-step', function(){  
            x--;
            console.log(x);
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

    //    $.ajaxSetup({
    //       headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //       }
    //   });

    //   $('#submit').click(function(){  
    //         console.log('masuk');
    //                   console.log(postURL);
    //                   console.log($('#add_name').serialize());
    //        $.ajax({  
    //             url:postURL,  
    //             method:"POST",  
    //             data:$('#add_name').serialize(),
    //             type:'json',
    //             success:function(data)  
    //             {
    //                   console.log("masuk");
    //                 if(data.error){
    //                     console.log("error");
    //                 }else{
    //                     window.location.href = data.url;
    //                 }
    //             }  
    //        });  
    //   });  
    });
    </script>
@endsection
@endsection
