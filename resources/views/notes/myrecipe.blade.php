@extends('main') 
@section('title', '| My Recipe') 
@section('content')
<center>
    <h1>My Recipe</h1>
</center>
@if(count($recipes)==0)
<div class="alert alert-danger">
    <strong>Info!</strong> You haven&apos;t create any recipe! To create a recipe click <a href="{{route('recipe.create')}}">here</a>
</div>
@else
<div class="row">
    @include('partials._recipe')
</div>
<div class="row justify-content-md-center">
    <div class="col-md-auto">
        <div class="text-center">{{$recipes->links()}}</div>
    </div>
</div>
@endif
@endsection