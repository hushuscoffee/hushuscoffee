@if($brewings->count()==0)
<div class="col-lg-12 mt-3 mb-3">
    <div class="alert alert-danger" role="alert">
        <strong>Wrong:</strong>
        <p>We couldn't find brewing method related to the search key</p>
    </div>
</div>
@else @foreach($brewings as $brewing)
<div class="col-lg-4 mt-3 mb-3">
    <div class="card h-100">
        <div class="card-body">
            <center><a href="{{route('myBrewing.show', $brewing->slug)}}"><img src="{{asset('uploads/brewings/'.$brewing->image)}}" alt="" height="150px"></a></center><br><br>
            <a href="{{route('myBrewing.show', $brewing->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$brewing->title}}">
                    <strong>
                      <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($brewing->title), 0, 70)}}{{strlen(strip_tags($brewing->title))>70?"...":""}}</p>
                    </strong>
                  </a>
            <p class="card-text">{{ substr(strip_tags($brewing->description), 0, 150)}} {{strlen(strip_tags($brewing->description))>150?"...":""}}</p>
        </div>
        <div class="card-footer">
            <a href="{{route('myBrewing.show', $brewing->slug)}}" class="btn btn-primary">Read More</a> @if(Auth::check())@if($brewing->user_id!=
            Auth::user()->id)
            <?php $favor=false; ?> @foreach ( $favourites as $fav) @if($fav->brewing_id == $brewing->id)
            <a href="{{route('favourite.remove', $fav->id)}}" class="btn btn-danger float-right"><i class="fa fa-heart"></i></a>
            <?php $favor=true; ?> @endif @endforeach @if($favor==false)
            <a href="{{route('favourite.add', [$brewing->id, 2])}}" class="btn btn-outline-danger float-right"><i class="fa fa-heart"></i></a>@endif
            @endif @endif
        </div>
    </div>
</div>
@endforeach @endif