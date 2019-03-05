@extends('main') 
@section('title', '| Register') 
@section('content')
<div class="row justify-content-center">
	<div class="col-md-4">
		<h1 class="text-center">Register</h1>
		<form method="POST" action="{{ route('getRegister') }}">
			{{ csrf_field() }}
			<div class="form-group{{ Session::has('username') ? ' has-error' : '' }}">
				<label for="username" class="col-md-12 control-label">Username</label>
				<div>
					<input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus min="5">					@if (Session::has('username'))
					<div class="alert alert-danger" role="alert">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<span class="help-block">
		                            <strong>{{ Session::get('username') }}</strong>
		                        </span>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group{{ Session::has('email') ? ' has-error' : '' }}">
				<label for="email" class="col-md-12 control-label">E-Mail Address</label>

				<div>
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required> @if (Session::has('email'))
					<div class="alert alert-danger" role="alert">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<span class="help-block">
		                            <strong>{{ Session::get('email') }}</strong>
		                        </span>
					</div>
					@endif
				</div>
			</div>

			<div class="form-group{{ Session::has('password') ? ' has-error' : '' }}">
				<label for="password" class="col-md-12 control-label">Password</label>

				<div>
					<input id="password" type="password" class="form-control" name="password" required min="8"> @if (Session::has('password'))
					<div class="alert alert-danger" role="alert">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<span class="help-block">
		                            <strong>{{ Session::get('password') }}</strong>
		                        </span>
					</div>
					@endif
				</div>
			</div>
			<div class="form-group">
				<label for="password-confirm" class="col-md-12 control-label">Confirm Password</label>

				<div>
					<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required min="8">
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-md-8">
						<div class="pull-left">
							Already have an account? <br>Sign In <a href="{{ route('getLogin') }}">here</a>
						</div>
					</div>
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary pull-right">Register</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection