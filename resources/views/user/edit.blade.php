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

    <form method="post" action="{{ route('users.update', $users->id) }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="form-group">
                <label for="name">Name : </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $users->name) }}"></input>
            </div>
            <div class="form-group">
                <label for="email">Email : </label>
                <input type="email"  class="form-control" name="email" id="email" value="{{ old('email', $users->email) }}"></input>
            </div>
            <div class="form-group">
                <label for="username">Username : </label>
                <input type="text" class="form-control" name="username" id="username" value="{{ old('username', $users->username) }}"></input>
            </div>
            <div class="form-group">
                <label for="password">Password : </label>
                <input type="password" class="form-control" name="password" id="password" value="{{ old('password', $users->password) }}"></input>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
    </form>
</div>

@endsection