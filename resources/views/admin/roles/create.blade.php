@extends('main_admin') 
@section('title', '| Admin - Roles') 
@section('content')

<form method="post" action="{{ route('role.store') }}" class="form-group container justify-content-md-center">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Role Name : </label>
        <input type="text" class="form-control" name="name" id="name"></input>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Create</button>
</form>
@endsection