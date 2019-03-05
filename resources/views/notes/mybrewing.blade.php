@extends('main') 
@section('title', '| My Brewing') 
@section('content')
<center>
    <h1>My Brewing Method</h1>
</center>
@if(count($brewings)==0)
<div class="alert alert-danger">
    <strong>Info!</strong> You haven&apos;t create any brewing method! To create a brewing method click <a href="{{route('brewing.create')}}">here</a>
</div>
@else 
<div class="row">
    @include('partials._brewing')
</div>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="text-center">{{$brewings->links()}}</div>
    </div>
</div>
@endif
@endsection