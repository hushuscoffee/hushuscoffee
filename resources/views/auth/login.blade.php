@extends('main')

@section('title',' Login')

@section('stylesheets')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@include('partials._nav')

<div class="container mt-5b">
    <div class="container row justify-content-center">
        <div class="col-md-4">
            <center><h1>Login</h1></center>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ Session::has('username') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-12 control-label">Username</label>
                    <div>
                        <input id="email" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                        @if (Session::has('username'))
                            <span class="help-block">
                                    <div class="alert alert-danger" role="alert">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{ Session::get('username') }} Please register <a href="{{ route('login') }}">here</a>.</strong>
                                    </div>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ Session::has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-12 control-label">Password</label>
                    <div>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if (Session::has('password'))
                        <div class="alert alert-danger" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span class="help-block">
                                <strong>{{ Session::get('password') }}</strong>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- <div class="form-group">
                    <div >
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                </div> --}}

                <div class="box-footer">
                    <div class="row">
                    <div class="col-md-8">
                    <div class="pull-left">
                        Do not have an account? Create one <a href="{{ route('register') }}">here</a>
                    </div></div>
                    <div class="col-md-4">
                    <button type="submit" class="btn btn-primary pull-right">Login</button>
                    </div>
                    </div>
                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a> --}}
                </div>
            </form>
        </div>
    </div>
</div>
<br><br><br><br><br>
@include('partials._javascript')
@section('scripts')
@endsection
@endsection
