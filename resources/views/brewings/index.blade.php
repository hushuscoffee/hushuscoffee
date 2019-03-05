@extends('main') 
@section('title', '| Brewings') 
@section('content')
<div class="row">
    <div class="col-md-4">
        <h1>BREWING</h1>
    </div>
    <div class="col-md-8">
        <form action="{{url('/brewing')}}">
            <div class="row">
                <div class="col-md-9 form-group">
                    <input type="text" class="form-control" name="search" id="search" style="font-size: 15px;" />
                </div>
                <div class="col-md-3">
                    <button type="submit" id="button-filter" class="btn btn-primary pull-right" style="margin-right: 20px">
              <i class="fa fa-search"></i> Search
            </button>
                </div>
            </div>
        </form>
    </div>
    @include('partials._brewing')
</div>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="text-center">{{$brewings->links()}}</div>
    </div>
</div>
@endsection