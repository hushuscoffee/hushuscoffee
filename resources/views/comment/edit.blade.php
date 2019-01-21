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

    <form method="post" action="{{ route('comments.update', $comments->id) }}" class="form-group container mt-5 justify-content-md-center">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <div class="form-group">
                <label for="text">Description : </label>
                <input type="text" class="form-control" id="text" name="text">{{ old('text', $comments->text) }}</input>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Update</button>
    </form>
</div>

@endsection