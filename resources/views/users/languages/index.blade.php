@extends('main') 
@section('title', '| Profile - Language') 
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
            <h3>Language</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <form class="mb-5" method="post" action="{{ route('language.create')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <p>Language</p>
                <input type="text" placeholder="ex: English" class="form-control" id="language" required name="language">
            </div>
            <div class="form-group">
                <p>Proficiency</p>
                <select class="form-control" id="lang-proficiency" required name="proficiency">
                                    <option value="Elementary">Elementary</option>
                                    <option value="Limited Working">Limited Working</option>
                                    <option value="Professional Working">Professional Working</option>
                                    <option value="Full Professional">Full Professional</option>
                                    <option value="Native or Bilingual">Native or Bilingual</option>
                                  </select>
            </div>
                <button type="submit" class="btn btn-primary pull-right">Save</button>
        </form>
    </div>
    <div class="col-md-5">
        @if($languages->count()!=0)@foreach($languages as $ln)
        <p>{{$ln->language}}</p>
        <p>{{$ln->proficiency}}</p>
        <form action="{{ route('language.delete', $ln->id) }}" method="POST">
            {{ csrf_field() }} {{ method_field('DELETE') }}
            <button onclick="window.location='{{ route('language.delete', $ln->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        <hr style="margin-bottom: 40px"> @endforeach @else
        <div class="alert alert-warning" role="alert">
            You haven't add any language yet
        </div>
        @endif
    </div>
</div>
@endsection