@extends('main_admin') 
@section('title', '| Admin - Status') 
@section('content')

<form method="post" action="{{ route('status.store') }}" class="form-group container justify-content-md-center">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Status Name : </label>
        <input type="text" class="form-control" name="name" id="name"></input>
    </div>
    <button type="submit" class="btn btn-primary pull-right">Create</button>
</form>
@endsection