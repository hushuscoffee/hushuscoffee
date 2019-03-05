@extends('main') 
@section('title', '| People') 
@section('content')
<div class="container mt-5b justify-content-center">
    <div class="text-center">
        <img src="{{ URL::to('images/avatar/'. $people->photo) }}" style="width: 8em" alt="User Image">
    </div>
    <div class="text-center mt-3">
        <h4>{{ $people['fullname'] }}</h4>
        <h5>{{ $people['profession'] }}</h5>
        <h6>{{ $people['address'] }}</h6>
        <h6>{{ $people['phone'] }}</h6>
        <h6>
            <ins>
                    <a href=" {{$people['sociallinks']}} ">
                        {{ $people['sociallinks'] }}
                    </a>
                </ins> &ensp;
            <ins>
                    <a href=" {{ $people['portfoliolinks'] }} ">
                        {{ $people['portfoliolinks'] }}
                    </a>
                </ins>
        </h6>
    </div>

    <hr>

    <div class="text-center lead">
        {{ $people['aboutme'] }}
    </div>
</div>

<hr>

<div class="container justify-content-center">
    <div class="container col-md-7">
        <h5 class="text-center">Achievements</h5>
        <hr> @if($achievement != null) @foreach($achievement as $award)
        <p>{{$award->title}}</p>
        <p>
            <a class="w3-text-blue" style="text-decoration: underline;" href="{{$award['link']}}" target="_blank">
                    {{$award['link']}}</a> {{$award['issuer']}}
        </p>
        <p>{{$award['month']}} {{$award['year']}}</p>
        <p>{{$award['description']}}</p>
        <hr> @endforeach @else
        <h5>-</h5>
        @endif
    </div>
    <div class="container col-md-7">
        <h5 class="text-center">Experience</h5>
        <hr> @if($experience != null) @foreach ($experience as $exp)
        <label>{{$exp->title}}</label>
        <p>{{$exp->company}}, {{$exp->location}}</p>
        <p>
            <a style="text-decoration: underline;" href="{{$exp->link}}" target="_blank">
                        {{$exp->link}}</a>
        </p>
        <p>{{$exp->monthf}} {{$exp->yearf}} - {{$exp->montht}} {{$exp->yeart}}</p>
        <p>{{$exp->description}}</p>
        <hr> @endforeach @endif
    </div>

    <div class="container col-md row text-center">
        <div class="container col-md">
            <h5>Skill</h5>
            <hr> @foreach($skill as $sk)
            <p>{{$sk->skill}}</p>
            <p>{{$sk->proficiency}} proficiency</p>
            <hr> @endforeach
        </div>

        <div class="container col-md">
            <h5>Languange</h5>
            <hr> @foreach($language as $lang)
            <p>{{$lang->language}}</p>
            <p>{{$lang->proficiency}} proficiency</p>
            <hr> @endforeach
        </div>
    </div>
</div>
@endsection