@extends('main') 
@section('title') | Brewing {{$brewing->title}}
@section('stylesheets')
<style>
    .image{
        width: 100%;
        height:auto;
    }
    .image-cover{
        width: 100%; 
        max-height:400px;
    }
</style>
@endsection
@endsection
 
@section('content')
<center>
    <h1>{{$brewing->title}}</h1>
</center>
<div class="row">
    <div class="col-md-8">
        <img class="image-cover" src="{{asset('uploads/brewings/'.$brewing->image)}}"/>
        <br><br>
        <h4>DESCRIPTION</h4>
        <p>{!!$brewing->description!!}</p>
        <hr>
        <h4>STEPS TO DO</h4>
        <?php $steps = json_decode($brewing->steps) ?>
        <?php $step_images = json_decode($brewing->step_images) ?>
        <?php $number=1 ?> @foreach($steps as $key => $step)
        <p style="font-weight: bolder; font-size: 22px;">Step {{$number}} </p> 
        <p>{!!$step!!}</p> @if($step_images[$key]!='none')
        <img src="{{asset('uploads/brewings/steps/'.$step_images[$key])}}" width="400px" /> @endif
        <hr><br>
        <?php $number++ ?> @endforeach
    </div>
    <div class="col-md-4">
        <?php $time = json_decode($brewing->time) ?>
        <?php $temperature = json_decode($brewing->temperature) ?>
        <?php $ingredients = json_decode($brewing->ingredients) ?>
        <?php $tools = json_decode($brewing->tools) ?>
        <h4>BREWING TIME </h4>
        <p>{{$time->time1}} - {{$time->time2}} {{$time->unit}}</p>
        <hr>
        <h4>WATER TEMPERATURE </h4>
        <p>{{$temperature->temperature}} {{$temperature->unit}}</p>
        <hr>
        <h4>INGREDIENTS</h4>
        @foreach($ingredients as $ing)
        <p>{{$ing->name}}: {{$ing->amount}} {{$ing->unit}}</p>
        @endforeach
        <hr>
        <h4>TOOLS</h4>
        @foreach($tools as $to)
        <p>{{$to->name}}: {{$to->amount}} {{$to->unit}}</p>
        @endforeach @if (Auth::check())
        @if (Auth::user()->id==$brewing->user_id)
            <hr><hr>
            <dl class="well">
                <dl class="dl-horizontal">
                    <label>Created At:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($brewing->created_at))}}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Last Updated:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($brewing->updated_at))}}</p>
                </dl>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('brewing.edit', $brewing->slug) }}" class="btn btn-primary btn-block">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::open(['route'=>['brewing.destroy',$brewing->id], 'method'=>'DELETE', 'onsubmit' => "return confirm('Are you sure
                        you want to delete?')"]) }} {{ Form::submit('Delete',['class'=>'btn btn-danger confirm btn-block'])
                        }} {{ Form::close() }}
                    </div>
                </div>
                <hr>
                @endif
        @endif
        <h5>Related Brewings</h5>
        <hr> @foreach ($brewings as $brewing)
        <div class="row">
            <div class="col-md-4">
                <a href="{{route('myBrewing.show', $brewing->slug)}}"><img class="image" src="{{asset('uploads/brewings/'.$brewing->image)}}"></a>
            </div>
            <div class="col-md-8">
                <a style="font-size:14px;" href="{{route('myBrewing.show', $brewing->slug)}}" data-toggle="tooltip" data-placement="left"
                    title="{{$brewing->title}}">{{$brewing->title}}</a>
                <p style="font-size:12px;">By : <a href="#" style="font-size:12px;">{{$brewing->user->profile->fullname}}</a> on {{$brewing->created_at}}</p>
            </div>
        </div>
        <hr> @endforeach
    </div>
</div>
@endsection