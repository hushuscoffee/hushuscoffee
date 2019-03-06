@extends('main') 
@section('title', '| Profile - Experience') 
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
            <h3>Experience</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7">
        <form class="mb-5" role="form" method="post" action="{{ route('experience.create') }}">
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
                <p>Company</p>
                <input type="text" class="form-control" id="company" required name="company">
            </div>
            <div class="form-group">
                <p>Position</p>
                <input type="text" class="form-control" id="position" required name="position">
            </div>
            <div class="form-group">
                <p>Location</p>
                <input type="text" class="form-control" id="location" required name="location">
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="form-check-input" name="status" value="1" id="status">
                <label class="form-check-label" for="status">Currently working here</label>
            </div>
            <div class="row mt-3" id="show_fields">
                <div class="form-group col-md-6">
                    <p>From Month</p>
                    <select class="form-control" id="monthf" name="monthf">
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
                    <br>
                    <p>From Year</p>
                    <select class="form-control" id="yearf" name="yearf">
                                    {{$date = date('Y')}} @while($date>=$beforeyear1)
                                    <option value="{{$date}}">{{$date}}</option>
                                    {{$date--}} @endwhile
                                  </select>
                </div>
                <div class="form-group col-md-6">
                    <p>To Month</p>
                    <select class="form-control" id="montht" name="montht">
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
                    <br>
                    <p>To Year</p>
                    <select class="form-control" id="yeart" name="yeart">
                                    {{$date = date('Y')}} @while($date>=$beforeyear1)
                                    <option value="{{$date}}">{{$date}}</option>
                                    {{$date--}} @endwhile
                                  </select>
                </div>
            </div>

            <div class="row mt-3" id="hidden_fields">
                <div class="form-group col-md-12">
                    <p>From Month</p>
                    <select class="form-control" id="monthf" name="monthf_check">
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
                    <br>
                    <p>From Year</p>
                    <select class="form-control" id="yearf" name="yearf_check">
                                                {{$date = date('Y')}} @while($date>=$beforeyear1)
                                                <option value="{{$date}}">{{$date}}</option>
                                                {{$date--}} @endwhile
                                              </select>
                </div>
            </div>
            <div class="form-group">
                <p>Description</p>
                <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Save</button>
        </form>
    </div>
    <div class="col-md-5">
        @if($experiences->count()!=0) @foreach ($experiences as $exp)
        <label>{{$exp->title}}</label>
        <p>{{$exp->company}}, {{$exp->location}}</p>
        <p>
            <a style="text-decoration: underline;" href="{{$exp->link}}" target="_blank">
                          {{$exp->link}}</a>
        </p>
        @if($exp->status==0)
        <p>{{$exp->monthf}} {{$exp->yearf}} - {{$exp->montht}} {{$exp->yeart}}</p>
        @else
        <p>Start from {{$exp->monthf}} {{$exp->yearf}} and currently working here</p>
        @endif
        <p>{{$exp->description}}</p>
        <form action="{{ route('experience.delete', $exp->id) }}" method="POST">
            {{ csrf_field() }} {{ method_field('DELETE') }}
            <button onclick="window.location='{{ route('experience.delete', $exp->id) }}'" class="btn btn-danger"><i class="fa fa-trash"></i></button>
        </form>
        <hr style="mb-3"> @endforeach @else
        <div class="alert alert-warning" role="alert">
            You haven't add any experience yet
        </div>
        @endif
    </div>
</div>
@endsection
 
@section('scripts')
<script>
    $(function() { var checkbox = $("#status"); var hidden = $("#hidden_fields"); var show = $("#show_fields"); hidden.hide(); show.show(); checkbox.change(function()
    { if (checkbox.is(':checked')) { show.hide(); hidden.show(); } else { hidden.hide(); show.show(); } }); });

</script>
@endsection