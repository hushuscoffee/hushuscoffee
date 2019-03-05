@extends('main') 
@section('title', '| Profile - Basic Information') 
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
            <h3>Basic Information</h3>
        </div>
    </div>
</div>
<form method="POST" action="{{route('profile.update')}}" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Photo</label><br>
                <img id="image" src="{{asset('images/avatar/'.$basic->photo)}}" height="200px">
                <input type="file" class="form-control" name="photo" id="DragAndDrop" onchange="imagePreview();">
            </div>
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="fullname" value="{{$basic['fullname']}}" required>
            </div>
            <div class="form-group">
                <label>Gender</label>
                <select class="form-control" id="gender" required name="gender">
                    <option value="Male" @if ($basic['gender'] == "Male") {{ 'selected' }} @endif>Male</option>
                    <option value="Female" @if ($basic['gender'] == "Female") {{ 'selected' }} @endif>Female</option>
                  </select>
            </div>
            <div class="form-group">
                <label>Birthday</label>
                <input type="date" class="date form-control" id="birthday" name="birthday" value="{{ $basic['birthday'] }}">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" class="form-control" name="phone" value="{{$basic['phone']}}">
            </div>            
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" name="city" value="{{$basic['city']}}" required>
            </div>
            <div class="form-group">
                <label>Profession</label>
                <input type="text" class="form-control" name="profession" value="{{$basic['profession']}}" required>
            </div>
            <div class="form-group">
                <label>Website/Blog/Facebook/Twitter/Medium</label>
                <input type="text" class="form-control" name="sociallinks" value="{{$basic['sociallinks']}}">
            </div>
            <div class="form-group">
                <label>Portfolio Link (LinkedIn/Docs)</label>
                <input type="text" class="form-control" name="portfoliolinks" value="{{$basic['portfoliolinks']}}">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea rows="3" class="form-control" name="address" value="" required>{{$basic['address']}}</textarea>
            </div>
            <div class="form-group">
                <label>Tell Us About You</label>
                <textarea rows="3" class="form-control" name="aboutme" value="">{{$basic['aboutme']}}</textarea>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right mb-3">Save</button>
            </div>
        </div>
    </div>
</form>
{{-- End Basic Profile Section --}}
@endsection
@section('scripts')
<script>
    function imagePreview() { var iRead = new FileReader(); iRead.readAsDataURL(document.getElementById("DragAndDrop").files[0]);
    iRead.onload = function(oFREvent) { document.getElementById("image").src = oFREvent.target.result; }; }
</script>
@endsection