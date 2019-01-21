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

    <form method="post" action="{{ route('articles.update', $articles->id) }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="form-group">
                <label for="description">Description : </label>
                <textarea cols="5" rows="5" class="form-control" id="description" name="description">{{ old('description', $articles->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="countComment">Comment Count : </label>
                <input type="number" min="0" class="form-control" name="countComment" id="countComment" value="{{ old('comment_count', $articles->comment_count) }}"></input>
            </div>
            <div class="form-group">
                <label for="upVote">Up Vote : </label>
                <input type="number" min="0" class="form-control" name="upVote" id="upVote" value="{{ old('upvote_count', $articles->upvote_count) }}"></input>
            </div>
            <div class="form-group">
                <label for="downVote">Up Vote : </label>
                <input type="number"min="0" class="form-control" name="downVote" id="downVote" value="{{ old('downvote_count', $articles->downvote_count) }}"></input>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
    </form>
</div>

@endsection