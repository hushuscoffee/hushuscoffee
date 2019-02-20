@extends('main_admin') 
@section('title', '| Admin - Category') 
@section('content')
<form method="post" action="{{ route('category.update', $category->id) }}" class="form-group container justify-content-md-center">
    {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="form-group">
        <label for="name">Category Name : </label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $category->name) }}"></input>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Update</button>
</form>
@endsection