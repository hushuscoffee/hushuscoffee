@extends('main') 
@section('title', '| Profile - Achievement') 
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
            <h3>Achievement</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <form class="mb-5" method="post" action="{{ route('achievement.create') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <p>Title</p>
                <input type="text" class="form-control" id="title" required name="title">
            </div>
            <div class="form-group">
                <p>Link</p>
                <input type="text" class="form-control" id="link" name="link">
            </div>
            <div class="form-group">
                <p>Organizer</p>
                <input type="text" class="form-control" id="issuer" required name="issuer">
            </div>
            <div class="form-group">
                <p>Month</p>
                <select class="form-control" id="month" name="month">
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                  </select>
            </div>
            <div class="form-group">
                <p>Year</p>
                <select class="form-control" id="year" name="year">
                                    {{$date = date('Y')}} 
                                    @while($date>=$beforeyear1)
                                      <option value="{{$date}}">{{$date}}</option>
                                      {{$date--}} 
                                    @endwhile
                                  </select>
            </div>
            <div class="form-group">
                <p>Description</p>
                <textarea class="form-control" id="description" rows="5" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Save</button>
        </form>
    </div>
    <div class="col-md-5">
        
        @if($achievements->count()!=0) @foreach ($achievements as $ach)
        <p>{{$ach->title}}</p>
        <p><a class="w3-text-blue" style="text-decoration: underline;" href="https://{{$ach->link}}" target="_blank">{{$ach->link}}</a>            {{$ach->issuer}}</p>
        <p>{{$ach->month}} {{$ach->year}}</p>
        <p>{{$ach->description}}</p>
        <form action="{{ route('achievement.delete', $ach->id) }}" method="POST">
            {{ csrf_field() }} {{ method_field('DELETE') }}
            <button onclick="window.location='{{ route('achievement.delete', $ach->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        <hr style="margin-bottom: 40px"> @endforeach @else
        <div class="alert alert-warning" role="alert">
            You haven't add any achievement yet
        </div>
        @endif
    </div>
</div>
@endsection
 
@section('scripts')

@endsection