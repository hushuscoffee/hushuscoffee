@if($articles->count()==0)
<div class="col-lg-12 mt-3 mb-3">
<div class="alert alert-danger" role="alert">
    <strong>Wrong:</strong>
    <p>We couldn't find article related to the search key</p>
</div>
</div>
@else
@foreach($articles as $article)
<div class="col-lg-4 mt-3 mb-3">
    <div class="card h-100">
        <div class="card-body">
            <center><img src="{{asset($article->image)}}" alt="" height="150px"></center><br><br>
            <a href="{{route('myArticle.show', $article->slug)}}" data-toggle="tooltip" data-placement="left" title="{{$article->title}}">
                    <strong>
                      <p style="font-size:18px;font-family:Avenir-Bold;">{{ substr(strip_tags($article->title), 0, 70)}}{{strlen(strip_tags($article->title))>70?"...":""}}</p>
                    </strong>
                  </a>
            <p class="card-text">{{ substr(strip_tags($article->description), 0, 150)}} {{strlen(strip_tags($article->description))>150?"...":""}}</p>
        </div>
        <div class="card-footer">
            <a href="#" class="btn btn-primary">Read More</a>
        </div>
    </div>
</div>
@endforeach
@endif