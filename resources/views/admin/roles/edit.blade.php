@extends('main_admin') 
@section('title', '| Admin - Roles') 
@section('content')
<form method="post" action="{{ route('role.update', $role->id) }}" class="form-group container justify-content-md-center">
    {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="form-group">
        <label for="name">Role Name : </label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $role->name) }}"></input>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Update</button>
</form>
@endsection