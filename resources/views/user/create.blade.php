@extends('layout.app')

@section('content')

<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif

    <form method="post" action="{{ route('users.store') }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" class="form-control" id="name" name="name"></input>
            </div>
            <div class="form-group">
                <label for="email">Email : </label>
                <input type="email" class="form-control" id="email" name="email"></input>
            </div>
            <div class="form-group">
                <label for="username">Username : </label>
                <input type="text" class="form-control" id="username" name="username"></input>
            </div>
            <div class="form-group">
                <label for="password">Password : </label>
                <input type="password" class="form-control" id="password" name="password"></input>
            </div>
            
            <button type="submit" class="btn btn-primary pull-right">Create</button>
    </form>
</div>

@endsection