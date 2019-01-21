<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Coffee</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{ route('personalize.index') }}">Personalize</a>
            </li> --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                CRUD
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('roles.index') }}">Role</a>
                <a class="dropdown-item" href="{{ route('users.index') }}">User</a>
                <a class="dropdown-item" href="{{ route('status.index') }}">Master Status</a>
                <a class="dropdown-item" href="{{ route('shared.index') }}">Master Shared</a>
                <a class="dropdown-item" href="{{ route('category.index') }}">Master Category</a>
                <a class="dropdown-item" href="{{ route('articles.index') }}">Article</a>
                <a class="dropdown-item" href="{{ route('article-image.index') }}">Article Image</a>
                <a class="dropdown-item" href="{{ route('article-report.index') }}">Article Report</a>
                <a class="dropdown-item" href="{{ route('comments.index') }}">Comment</a>
                <a class="dropdown-item" href="{{ route('comment-report.index') }}">Comment Report</a>
                <a class="dropdown-item" href="{{ route('votes.index') }}">Vote</a>
                <a class="dropdown-item" href="{{ route('jobs.index') }}">Job</a>
                <a class="dropdown-item" href="{{ route('groups.index') }}">Group</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>