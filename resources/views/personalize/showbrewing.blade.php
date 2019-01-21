@extends('main')
@section('title',' My Brewing')
@section('stylesheets')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    h1,h4{
        font-weight: bolder;
    }
</style>
@endsection
@section('content')
@include('partials._nav')
<br>
        <div class="container mt-5b" style="font-size: 15px;">    
        <center><strong><h1>{{$article->title}}</h1></strong></center>
        {{-- <center><img src="{{asset($article->file)}}" width="500px"/></center> --}}
        <br>
        <div class="row">
		<div class="col-md-8">
            <h4>DESCRIPTION</h4>
            <p>{{$article->description}}</p>
            <hr>
            <?php $number=1 ?> 
    <h4>STEPS TO DO</h4>
    @foreach($steps as $step)
        <label style="font-weight: bolder; font-size: 22px;">Step {{$number}} </label>
        <p>{{$step->description}}</p>
        @if($step->file!='none')
        <img src="{{asset($step->file)}}" width="400px"/>
        @endif
        <hr>
        <?php $number++ ?> 
    @endforeach
    </div>
		<div class="col-md-4">
            @foreach($ingredients as $ing)
        @if($ing->nama=='Time')
            <h4>BREWING TIME </h4><p>{{$ing->jumlah}} {{$ing->satuan}}</p>
            <br>
        @endif
        @if($ing->nama=='Temperature')
            <h4>WATER TEMPERATURE </h4><p>{{$ing->jumlah}} {{$ing->satuan}}</p>
            <br>
        @endif
    @endforeach
    <h4>INGREDIENTS</h4>
    @foreach($ingredients as $ing)
        @if($ing->nama!='Time' && $ing->nama!='Temperature')
        <p>{{$ing->nama}}: {{$ing->jumlah}} {{$ing->satuan}}</p>
        @endif
    @endforeach
    <br>
    <h4>TOOLS</h4>
    @foreach($tools as $tol)
        <p>{{$tol->nama}}: {{$tol->jumlah}} {{$tol->satuan}}</p>
    @endforeach
    <br>
    <dl class="dl-horizontal">
                <label>Created At:</label>
                <p>{{ date('M j, Y h:ia', strtotime($article->created_at))}}</p>
            </dl>
            <dl class="dl-horizontal">
                <label>Last Updated:</label>
                <p>{{ date('M j, Y h:ia', strtotime($article->updated_at))}}</p>
            </dl>
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('personalize.editbrewing', $article->slug) }}" class="btn btn-primary btn-block">Edit</a>
                </div>
                <div class="col-sm-6">
                    {{ Form::open(['route'=>['personalize.destroybrewing',$article->id], 'method'=>'DELETE']) }}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger confirm btn-block', 'data-confirm' => 'Are you sure you want to delete?']) }}
                    {{ Form::close() }}
                </div>
            </div>
		</div>
        </div>    
        </div>
      @include('partials._javascript')
@endsection

@section('scripts')
    <script>
        $('.confirm').on('click', function (e) {
        if (confirm($(this).data('confirm'))) {
            return true;
        }
        else {
            return false;
        }
    });
    </script>
@endsection