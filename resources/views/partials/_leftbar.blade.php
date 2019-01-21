<style>
    a{
        color:black;
    }
    a:hover{
        color:grey;
    }
</style>
<br><br>
<div id="accordion">

  <div class="card">
    <div class="card-header"  style="background-color:#ffcd22">
      <a class="card-link btn-block" data-toggle="collapse" href="#collapseOne">
        <i class="fa fa-list-ul"></i> Master Data <i class="fa fa-caret-down"></i>
      </a>
    </div>
    <div id="collapseOne" class="collapse" data-parent="#accordion">
      <div class="card-body">
        <a class="dropdown-item" href="{{ route('roles.index') }}">Role</a>
                <a class="dropdown-item" href="{{ route('status.index') }}">Master Status</a>
                <a class="dropdown-item" href="{{ route('shared.index') }}">Master Shared</a>
                <a class="dropdown-item" href="{{ route('category.index') }}">Master Category</a>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header"  style="background-color:#ffcd22">
      <a class="card-link btn-block" href="{{ route('user') }}">
        <i class="fa fa-users"></i> User
      </a>
    </div>
    {{-- <div id="collapseTwo" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Lorem ipsum..
      </div>
    </div> --}}
  </div>

  {{-- <div class="card">
    <div class="card-header"  style="background-color:#ffcd22">
      <a class="card-link btn-block" href="{{ route('user') }}">
        <i class="fa fa-user-secret"></i> Admin 
      </a>
    </div>
    <div id="collapseTwo" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Lorem ipsum..
      </div>
    </div>
  </div> --}}

  {{-- <div class="card">
    <div class="card-header"  style="background-color:#ffcd22">
      <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
        Collapsible Group Item #3
      </a>
    </div>
    <div id="collapseThree" class="collapse" data-parent="#accordion">
      <div class="card-body">
        Lorem ipsum..
      </div>
    </div>
  </div> --}}

</div>

