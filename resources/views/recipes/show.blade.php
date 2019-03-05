@extends('main') 
@section('title') | Recipe {{$recipe->title}}
@section('stylesheets')
<style>
    .image {
        width: 100%;
        height: auto;
    }

    .image-cover {
        width: 100%;
        max-height: 400px;
    }
</style>
</style>
@endsection
@endsection
 
@section('content')
<center>
    <h1>{{$recipe->title}}</h1>
</center>
<div class="row">
    <div class="col-md-8">
        <img class="image-cover" src="{{asset('uploads/recipes/'.$recipe->image)}}" />
        <br><br>
        <h4>DESCRIPTION</h4>
        <p>{!!$recipe->description!!}</p>
        <hr>
        <h4>STEPS TO DO</h4>
        <?php $steps = json_decode($recipe->steps) ?>
        <?php $step_images = json_decode($recipe->step_images) ?>
        <?php $number=1 ?> @foreach($steps as $key => $step)
        <p style="font-weight: bolder; font-size: 22px;">Step {{$number}} </p> 
        <p>{!!$step!!}</p> @if($step_images[$key]!='none')
        <img src="{{asset('uploads/recipes/steps/'.$step_images[$key])}}" width="400px" /> @endif
        <hr><br>
        <?php $number++ ?> @endforeach
    </div>
    <div class="col-md-4">
        <?php $ingredients = json_decode($recipe->ingredients) ?>
        <?php $tools = json_decode($recipe->tools) ?>
        <h4>INGREDIENTS</h4>
        @foreach($ingredients as $ing)
        <p>{{$ing->name}}: {{$ing->amount}} {{$ing->unit}}</p>
        @endforeach
        <hr>
        <h4>TOOLS</h4>
        @foreach($tools as $to)
        <p>{{$to->name}}: {{$to->amount}} {{$to->unit}}</p>
        @endforeach @if (Auth::check())
        @if (Auth::user()->id==$recipe->user_id)
            <br><hr>
            <dl class="well">
                <dl class="dl-horizontal">
                    <label>Created At:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($recipe->created_at))}}</p>
                </dl>
                <dl class="dl-horizontal">
                    <label>Last Updated:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($recipe->updated_at))}}</p>
                </dl>
                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('recipe.edit', $recipe->slug) }}" class="btn btn-primary btn-block">Edit</a>
                    </div>
                    <div class="col-sm-6">
                        {{ Form::open(['route'=>['recipe.destroy',$recipe->id], 'method'=>'DELETE', 'onsubmit' => "return confirm('Are you sure
                        you want to delete?')"]) }} {{ Form::submit('Delete',['class'=>'btn btn-danger confirm btn-block'])
                        }} {{ Form::close() }}
                    </div>
                </div>
                <hr>
                @endif
        @endif
        <h5>Related Recipes</h5>
        <hr> @foreach ($recipes as $recipe)
        <div class="row">
            <div class="col-md-4">
                <a href="{{route('myRecipe.show', $recipe->slug)}}"><img class="image" src="{{asset('uploads/recipes/'.$recipe->image)}}"></a>
            </div>
            <div class="col-md-8">
                <a style="font-size:14px;" href="{{route('myRecipe.show', $recipe->slug)}}" data-toggle="tooltip" data-placement="left"
                    title="{{$recipe->title}}">{{$recipe->title}}</a>
                <p style="font-size:12px;">By : <a href="#" style="font-size:12px;">{{$recipe->user->profile->fullname}}</a> on {{$recipe->created_at}}</p>
            </div>
        </div>
        <hr> @endforeach
    </div>
</div>
@endsection