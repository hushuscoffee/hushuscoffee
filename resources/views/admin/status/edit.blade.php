@extends('main_admin') 
@section('title', '| Admin - Status') 
@section('content')
<form method="post" action="{{ route('status.update', $status->id) }}" class="form-group container justify-content-md-center">
    {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="form-group">
        <label for="name">Status Name : </label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $status->name) }}"></input>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Update</button>
</form>
@endsection