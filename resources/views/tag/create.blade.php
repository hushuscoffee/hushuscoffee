@extends('layout.app')

@section('content')

<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif

    <form method="post" action="{{ route('tag.store') }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Tag Name : </label>
                <input type="text" class="form-control" name="name" id="name"></input>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Create</button>
    </form>
</div>

@endsection