<div style="margin-top:10px"></div>
@if (Session::has('success'))
<div class="container">
    <div class="alert alert-warning" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('success')}}
    </div>
</div>
@elseif (Session::has('error'))
<div class="container">
    <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('error')}}
    </div>
</div>
@endif
