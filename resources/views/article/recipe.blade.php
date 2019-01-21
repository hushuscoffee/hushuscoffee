@extends('main')
@section('title',' My Recipe')
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
        <div class="container mt-5">    
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
            {{-- @foreach($ingredients as $ing)
        @if($ing->nama=='Time')
            <h4>MAKING TIME </h4><p>{{$ing->jumlah}} {{$ing->satuan}}</p>
            <br>
        @endif
        @if($ing->nama=='Temperature')
            <h4>WATER TEMPERATURE </h4><p>{{$ing->jumlah}} {{$ing->satuan}}</p>
            <br>
        @endif
    @endforeach --}}
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
		</div>
        </div>  
        <section class="comment">
@include('partials._commentview')
@include('partials._commentform')
</section>  
        </div>
      @include('partials._javascript')
@endsection