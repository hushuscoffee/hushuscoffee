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

    <form method="post" action="{{ route('votes.update', $votes->id) }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="form-group">
                <label for="vote">Vote : </label>
                <input type="number" min="0" class="form-control" name="vote" id="vote" value="{{ old('vote', $votes->vote) }}"></input>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
    </form>
</div>

@endsection