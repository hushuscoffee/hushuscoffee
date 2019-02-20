@extends('main') 
@section('title', '| Profile - Change Password') 
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('partials._navProfile')
    </div>
</div>
{{-- Basic Profile Section --}}
<div class="row">
    <div class="col-md-12">
        <div class="mt-3">
            <h3>Change Password</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <form class="w3-margin-top" method="POST" action="{{route('password.change')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <p>Old Password</p>
                <input type="password" class="form-control" required name="old"  minlength="8">
            </div>
            <div class="form-group">
                <p>New Password</p>
                <input type="password" class="form-control" min="8" required name="password" minlength="8">
            </div>
            <div class="form-group">
                <p>Re-Type Password</p>
                <input type="password" class="form-control" min="8" required name="matchpwd" minlength="8">
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right mb-3">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection