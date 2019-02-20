@extends('main') 
@section('title', '| Profile - Skill') 
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
            <h3>Skill</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <form class="mb-5" enctype="multipart/form-data" role="form" method="post" action="{{ route('skill.create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <p>Name</p>
                <input type="text" placeholder="ex: Barista" class="form-control" id="skill" required name="skill">
            </div>
            <div class="form-group">
                <p>Proficiency</p>
                <select class="form-control" id="skill-proficiency" required name="proficiency">
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                    <option value="Professional">Professional</option>
                                  </select>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Save</button>
        </form>
    </div>
    <div class="col-md-5">
        @if($skills->count()!=0)@foreach($skills as $sk)
        <p>{{$sk->skill}}</p>
        <p>{{$sk->proficiency}}</p>
        <form action="{{ route('skill.delete', $sk->id) }}" method="POST">
            {{ csrf_field() }} {{ method_field('DELETE') }}
            <button onclick="window.location='{{ route('skill.delete', $sk->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        <hr style="margin-bottom: 40px"> @endforeach @else
        <div class="alert alert-warning" role="alert">
            You haven't add any skill yet
        </div>
        @endif
    </div>
</div>
@endsection