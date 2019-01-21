@extends('main')
@section('title',' Admin-Dashboard')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
@include('partials._nav')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('partials._leftbar')
        </div>
        <div class="col-md-9">
            <br><br>
    <form method="post" action="{{ route('category.store') }}" class="form-group container justify-content-md-center">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" class="form-control" id="name" name="name"></input>
            </div>
            <div class="form-group">
                <label for="description">Description : </label>
                <textarea cols="5" rows="5" class="form-control" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Create</button>
    </form>
        </div>
</div>
</div>
<br>
@include('partials._javascript')
@endsection
