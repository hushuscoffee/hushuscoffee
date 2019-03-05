@extends('main') @if ($category==1) 
@section('title', '| Events') @elseif($category==2) 
@section('title', '| News') @elseif($category==3)

@section('title', '| Tips') @endif 
@section('content')
<div class="row">
    <div class="col-md-4">
        <h1>@if ($category==1) EVENTS @elseif($category==2) NEWS @elseif($category==3) TIPS @endif</h1>
    </div>
    <div class="col-md-8">
        @if ($category==1) <form action="{{url('/article/events')}}"> @elseif($category==2) <form action="{{url('/article/news')}}"> @elseif($category==3) <form action="{{url('/article/tips')}}"> @endif
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
    @include('partials._article')
</div>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="text-center">{{$articles->links()}}</div>
    </div>
</div>
@endsection