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

    <form method="post" action="{{ route('articles.store') }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
        <div class="form-group">
                <label for="description">Description : </label>
                <textarea cols="5" rows="5" class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="countComment">Comment Count : </label>
                <input type="number" min="0" class="form-control" name="countComment" id="countComment"></input>
            </div>
            <div class="form-group">
                <label for="upVote">Up Vote : </label>
                <input type="number" min="0" class="form-control" name="upVote" id="upVote"></input>
            </div>
            <div class="form-group">
                <label for="downVote">Up Vote : </label>
                <input type="number"min="0" class="form-control" name="downVote" id="downVote"></input>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Create</button>
    </form>
</div>

@endsection