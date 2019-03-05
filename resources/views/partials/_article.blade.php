@if($articles->count()==0)
<div class="col-lg-12 mt-3 mb-3">
    <div class="alert alert-danger" role="alert">
        <strong>Wrong:</strong>
        <p>We couldn't find article related to the search key</p>
    </div>
</div>
@else @foreach($articles as $article)
<div class="col-lg-4 mt-3 mb-3">
    <div class="card h-100">
        <div class="card-body">
            <center><a href="{{route('myArticle.show', $article->slug)}}"><img src="{{asset('uploads/articles/'.$article->image)}}" alt="" height="150px"></a></center><br><br>
            <a href="{{route('myArticle.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
                    <strong>
                      <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
                    </strong>
                  </a>
            <p class="card-text">{{ substr(strip_tags($article->description), 0, 150)}} {{strlen(strip_tags($article->description))>150?"...":""}}</p>
        </div>
        <div class="card-footer">
            <a href="{{route('myArticle.show', $article->slug)}}" class="btn btn-primary">Read More</a> @if(Auth::check())
            @if($article->user_id != Auth::user()->id)
            <?php $favor=false; ?> @foreach ( $favourites as $fav) @if($fav->article_id == $article->id)
            <a href="{{route('favourite.remove', $fav->id)}}" class="btn btn-danger float-right"><i class="fa fa-heart"></i></a>
            <?php $favor=true; ?> @endif @endforeach @if($favor==false)
            <a href="{{route('favourite.add', [$article->id, 1])}}" class="btn btn-outline-danger float-right"><i class="fa fa-heart"></i></a>@endif @endif @endif
        </div>
    </div>
</div>
@endforeach @endif