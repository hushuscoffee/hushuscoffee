@extends('layout.app')

@section('content')

<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif

    <form method="post" action="{{ route('article-image.store') }}" enctype="multipart/form-data" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}

        <div class="col-md-4 img-form" >
            <input type="file" name="image[]" id="image" multiple="true" />
            <img src="" id="img-tag" width="250px" />
          </div>

                {{--  <div class="input-group control-group increment col-md-6">
                    <input type="file" id="image" name="image[]" multiple="true" class="form-control">
                    <div class="input-group-btn"> 
                        <button id="add" class="btn btn-success" type="button"><i class="fa fa-plus-circle"></i> Add</button>
                    </div>
                </div>
                <div class="clone hide col-md-6" style="display: none">
                    <div class="control-group input-group col-md-6" style="margin-top:10px">
                    <input type="file" name="image[]" multiple="true" class="form-control">
                    <div class="input-group-btn"> 
                        <button id="remove" class="btn btn-danger" type="button"><i class="fa fa-times-circle"></i> Remove</button>
                    </div>
                    </div>
                </div>        --}}
            <button type="submit" class="btn btn-primary pull-right">Create</button>
    </form>

    @section('scripts')
    <script type="text/javascript">
        function readURL(input) {
          if (input.files && input.files[0]) {  
            var reader = new FileReader();

            reader.onload = function (e) {
              $('#img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#image").change(function(){
          readURL(this);
        });
      </script>
        {{--  <script type="text/javascript">
            $(document).ready(function() {

                //$('.clone').hide();

                $(".btn-success").click(function(){ 
                    var html = $(".clone").html();
                    $(".increment").after(html);
                });
          
                $("body").on("click", "#remove",function(){ 
                    $(this).parents(".control-group").remove();
                });
          
              });
        </script>  --}}
    @endsection

@endsection