@extends('main')
@section('title',' Home')
@section('stylesheets')
  <!-- Custom styles for this template -->
    <link href="{{ asset('css/business-casual.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/creative.min.css')}}" rel="stylesheet">
    <link href="{{ asset('vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    {{-- <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span class="site-heading-upper text-primary mb-3">A Free Bootstrap 4 Business Theme</span>
      <span class="site-heading-lower">Business Casual</span>
    </h1> --}}
    @include('partials._nav')
    <section class="clearfix">
<div class="container" style="max-width: 90%;">
  <div class="jumbotron" style="background-color:rgba(255, 255, 255, 0.1); color:white;">
<form class="form-group justify-content-md-center" name="add_name" id="add_name">
    <center><h1>Create Your Own Technique</h1></center>
    <div class="form-row mt-3">
        <div class="col-md-6 mb-3">

            <div class="form-group">
                <h3 for="Title" class="bold font-italic font-recipe-title">Title</h3>
                <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Write your title here . . . " required>
            </div>

            <div class="form-group">
                <h3 for="Url" class="bold font-italic font-recipe-url">Url</h3>
                <input type="text" name="slug" class="form-control" id="inputUrl" placeholder="Write your url here . . . " required>
            </div>

            {{--  <div class="form-group">
                <h3 for="Category" class="bold font-italic font-recipe-url">Category</h3>
                <select name="category" id="category" class="form-control">
                    @foreach($categorys as $category)
                        <option value="{{ $category->id }}">{{ $category->name}}</option>
                    @endforeach
                </select>
            </div>  --}}

            <div class="input-group">
                <input id="thumbnail" class="form-control" type="text" name="filepath">&nbsp;
                <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose
                    </a>
                </span>
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <h3 for="Description" class="bold font-italic font-recipe-title">Description</h3>
            <textarea name="description" rows="7" class="form-control" id="inputDescription" placeholder="Your description here" required></textarea>
        </div>
 
    </div>

    <div class="content_step">
        <div class="form-group mt-5">
            <h4 class="bold font-italic font-recipe-title"> Step <img src="{{ URL::to('/images/step.png') }}" style="width: 25px; height: 25px">  </h4>
                <div class="form-row">
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="step" placeholder="What's the step" name="step[]">
                    </div>
                    <div class="col form-group">
                        <button id="add_step" type="button" class="btn btn-outline-info pull-right add-step"><img src="{{ URL::to('/images/list.png') }}" style="width: 25px; height: 25px"> </button>
                    </div>
                </div> 
        </div>
    </div>

    <div class="form-group pull-right">
        {{-- <input  type="button" name="submit" id="submit" class="btn btn-outline-info btn-lg pull-right"><img src="{{ URL::to('/images/checked.png') }}" style="width: 35px; height: 35px"> Save My Recipe</input> --}}
        <input  type="button" name="submit" id="submit" class="btn btn-outline-info btn-lg pull-right" value="Save My Technique"/>
    </div>
</form>
  </div>
</div>

@include('partials._javascript')
@section('scripts')
    <script>
        
    $(document).ready(function(){
        var postURL = "<?php echo url('create-technique'); ?>"
        var i = 1;
        $('.add-step').click(function(){
            i++;
            $('.content_step').append('<div id="content_step'+i+'" class="form-group mt-4"> <div class="form-row"><div class="col-sm-10"> <input name="step[]" type="text" class="form-control" id="step" placeholder="Whats the step"> </div> <div class="col"> <button type="button" id="'+i+'" class="btn btn-outline-danger pull-right remove-step"><img src="{{ URL::to('/images/list_remove.png') }}" style="width: 25px; height: 25px"> </button> </div> </div> </div> </div>');
        });

        $(document).on('click', '.remove-step', function(){  
            var button_id = $(this).attr("id");   
            $('#content_step'+button_id+'').remove();  
       });

       $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        console.log("error");
                    }else{
                        window.location.href = data.url;
                    }
                }  
           });  
      });  
    });

    </script>
    </section>
@endsection