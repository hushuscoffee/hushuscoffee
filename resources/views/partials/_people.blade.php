@if($people->count()==0)
<div class="col-lg-12 mt-3 mb-3">
    <div class="alert alert-danger" role="alert">
        <strong>Wrong:</strong>
        <p>We couldn't find people related to the search key</p>
    </div>
</div>
@else @foreach($people as $p)
<div class="col-lg-3 mb-4">
    <div class="card h-100">
        <div class="card-body">
            <div class="text-center">
                <img src="{{ URL::to('images/avatar/'. $p->photo) }}" height="150px" alt="User Image">
            </div>
            <br>
            <div class="container mt-3 display-5 text-muted text-center" style="font-size:18px;font-family:Avenir-Bold;">
                {{ $p->fullname }}
            </div>
            <br>
            <p class="card-text">{{ substr(strip_tags($p->aboutme), 0, 150)}} {{strlen(strip_tags($p->aboutme))>150?"...":""}}</p>
        </div>
        <div class="card-footer">
            <a href=" {{ route('people.show', $p->user_id) }} " class="btn btn-primary">See Profile</a>
        </div>
    </div>
</div>
@endforeach @endif