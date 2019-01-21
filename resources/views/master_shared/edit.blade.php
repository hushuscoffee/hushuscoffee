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
    <form method="post" action="{{ route('shared.update', $shared->id) }}" class="form-group container justify-content-md-center">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">Shared Name : </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $shared->name) }}"></input>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
    </form>
        </div>
</div>
</div>
<br>
@include('partials._javascript')
@endsection