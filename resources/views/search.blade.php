@extends('main') 
@section('title', '| Search')
@section('content')
@if($articles->count()==0 && $brewings->count()==0 && $recipes->count()==0 && $people->count()==0)
<div class="col-lg-12 mt-3 mb-3">
    <div class="alert alert-danger" role="alert">
        <strong>Wrong:</strong>
        <p>We couldn't find anything related to the search key</p>
    </div>
</div>
@endif
@if($articles->count()>0)
<div class="row">
    <h1>Articles</h1>
</div>
<div class="row">
    @include('partials._article')
</div>
<hr>
@endif
@if($brewings->count()>0)
<div class="row">
    <h1>Brewings</h1>
</div>
<div class="row">
    @include('partials._brewing')
</div>
<hr>
@endif
@if($recipes->count()>0)
<div class="row">
    <h1>Recipes</h1>
</div>
<div class="row">
    @include('partials._recipe')
</div>
<hr>
@endif
@if($people->count()>0)
<div class="row">
    <h1>People</h1>
</div>
<div class="row">
    @include('partials._people')
</div>
@endif
@endsection